<?php

namespace App\Http\Controllers;

use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Fund;
use App\Models\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Facades\App\Services\BasicService;

//extra
use App\Models\Investment;

class PaymentController extends Controller
{
    use Notify, Upload;

    public function addFundRequest(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'gateway' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 422);
        }

        $basic = (object)config('basic');
        $gate = Gateway::where('code', $request->gateway)->where('status', 1)->first();
        if (!$gate) {
            return response()->json(['error' => 'Invalid Gateway'], 422);
        }

        $reqAmount = $request->amount;
        if ($gate->min_amount > $reqAmount || $gate->max_amount < $reqAmount) {
            return response()->json(['error' => 'Please Follow Transaction Limit'], 422);
        }


        $charge = getAmount($gate->fixed_charge + ($reqAmount * $gate->percentage_charge / 100));
        $payable = getAmount($reqAmount + $charge);
        $final_amo = getAmount($payable * $gate->convention_rate);
        $user = auth()->user();
        $fund = $this->newFund($request, $user, $gate, $charge, $final_amo, $reqAmount);

        session()->put('track', $fund['transaction']);


        if (1000 > $fund->gateway->id) {
            $method_currency = (checkTo($fund->gateway->currencies, $fund->gateway_currency) == 1) ? 'USD' : $fund->gateway_currency;
            $isCrypto = (checkTo($fund->gateway->currencies, $fund->gateway_currency) == 1) ? true : false;
        } else {
            $method_currency = $fund->gateway_currency;
            $isCrypto = false;
        }


        return [
            'gateway_image' => getFile(config('location.gateway.path') . $gate->image),
            'amount' => getAmount($fund->amount) . ' ' . $basic->currency_symbol,
            'charge' => getAmount($fund->charge) . ' ' . $basic->currency_symbol,
            'gateway_currency' => trans($fund->gateway_currency),
            'payable' => getAmount($fund->amount + $fund->charge) . ' ' . $basic->currency_symbol,
            'conversion_rate' => 1 . ' ' . $basic->currency . ' = ' . getAmount($fund->rate) . ' ' . $method_currency,
            'in' => trans('In') . ' ' . $method_currency . ':' . getAmount($fund->final_amount, 2),
            'isCrypto' => $isCrypto,
            'conversion_with' => ($isCrypto) ? trans('Conversion with') . $fund->gateway_currency . ' ' . trans('and final value will Show on next step') : null,
            'payment_url' => route('user.addFund.confirm'),
        ];
    }

    public function depositConfirms(Request $request) //extra
    {
        $user = auth()->user();
        $basic = (object)config('basic');
        $trx = strRandom();
        $remarks = 'Invested On Properties';

        $gate = Gateway::where('id', $request->gateway)->where('status', 1)->first();
        if (!$gate) {
            return response()->json(['error' => 'Invalid Gateway'], 422);
        }

        $order = new \stdClass();
        $order->user = $user;
        $order->final_amount = $request->amount;
        $order->amount = $request->amount;
        $order->gateway_currency = $basic->currency;
        $order->transaction = $trx;
        $order->gateway = $gate;
        $order->investments_id = $request->investments_id;
        $order->investments_amount = $request->investments_amount;
        $order->investments_card_quantity = $request->investments_card_quantity;
        //$order->card_quantity = $request->card_quantity;
        $order->property_id = NULL;

        /* dd($order);
        die; */

        if (999 < $gate->id) {
            return view(template() . 'user.payment.manualpay', compact('order'));
        }

        $reqAmount = $request->amount;
        if ($gate->min_amount > $reqAmount || $gate->max_amount < $reqAmount) {
            return back()->with('error', 'Please Follow Transaction Limit');
            //return response()->json(['error' => 'Please Follow Transaction Limit'], 422);
        }

        $method = $gate->code;
        try {

            $getwayObj = 'App\\Services\\Gateway\\' . $method . '\\Payment';
            $data = $getwayObj::prepareData($order, $gate);
            $data = json_decode($data);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
        if (isset($data->error)) {
            return back()->with('error', $data->message);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }
        $page_title = 'Payment Confirm';

        /* $order->user->total_deposit += $order->amount;
        $order->user->save(); */

        return view(template() . $data->view, compact('data', 'page_title', 'order'));
    }

    public function depositConfirm(Request $request)
    {
        $track = session()->get('track');
        $order = Fund::where('transaction', $track)->orderBy('id', 'DESC')->with(['gateway', 'user'])->first();
        if (is_null($order)) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        }
        if ($order->status != 0) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        }
        if (999 < $order->gateway->id) {
            return view(template() . 'user.payment.manual', compact('order'));
        }

        $method = $order->gateway->code;
        try {

            $getwayObj = 'App\\Services\\Gateway\\' . $method . '\\Payment';
            $data = $getwayObj::prepareData($order, $order->gateway);
            $data = json_decode($data);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
        if (isset($data->error)) {
            return back()->with('error', $data->message);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }
        $page_title = 'Payment Confirm';

        $order->user->total_deposit += $order->amount;
        $order->user->save();
        return view(template() . $data->view, compact('data', 'page_title', 'order'));
    }

    public function fromSubmit(Request  $request)
    {

        /* dd("xxx");
        die; */

        //$track = session()->get('track');
        //$data = Fund::where('transaction', $track)->orderBy('id', 'DESC')->with(['gateway', 'user'])->first();
        /* $data = Investment::where('transaction', $track)->orderBy('id', 'DESC')->with(['gateway', 'user'])->first();
        if (is_null($data)) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        }
        if ($data->status != 0) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        } */

        $gateway = Gateway::where('code', $request->code)->first();

        $basic = (object) config('basic');
        $order = (object) $request->order;
        $user = auth()->user();
        $charge = getAmount($gateway->fixed_charge + ($order->final_amount * $gateway->percentage_charge / 100));
        $remarks = 'Invested On Properties';
        BasicService::makeTransaction($user, $order->final_amount, $charge, '+', 'balance', $request->trx, $remarks);

        /* $data->created_at = Carbon::now();
        $data->status = 2; // pending
        $data->update(); */

        foreach ($request->investments_id as $key => $id) {
            $myInvest = Investment::findOrFail($id);
            $myInvest->amount = $request->investments_amount[$key];
            $myInvest->is_active = 1;
            $myInvest->gateway_id = $gateway->id;
            $myInvest->gateway_currency = strtoupper($gateway->currency);
            $myInvest->charge = 0;
            $myInvest->rate = $gateway->convention_rate;
            $myInvest->final_amount = $myInvest->amount;
            $myInvest->btc_amount = 0;
            $myInvest->btc_wallet = "";
            $myInvest->transaction = $request->trx; //extra trx
            $myInvest->try = 0;
            $myInvest->payment_status = 1;
            $myInvest->status = 2; //extra pending
            $myInvest->card_quantity = $myInvest->card_quantity + $request->investments_card_quantity[$key];

            $myInvest->save();
        }

        $msg = [
            'username' => $user->username,
            'amount' => getAmount($order->final_amount),
            'currency' => $basic->currency,
            'gateway' => $gateway->name
        ];
        $action = [
            "link" => route('admin.payment.pending', $user->id),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $currentDate = dateTime(Carbon::now());
        $this->adminPushNotification('ADMIN_NOTIFY_PAYMENT_REQUEST', $msg, $action);
        $this->mailToAdmin($type = 'ADMIN_MAIL_PAYMENT_REQUEST', [
            'username' => $user->username,
            'amount' => getAmount($order->final_amount),
            'currency' => $basic->currency,
            'gateway' => $gateway->name,
            'date' => $currentDate
        ]);

        $userAction = [
            "link" => route('user.fund-history'),
            "icon" => "fa fa-money-bill-alt text-white"
        ];

        $this->userPushNotification($user, 'USER_NOTIFY_PAYMENT_REQUEST', $msg, $userAction);
        $this->sendMailSms($user, 'USER_MAIL_PAYMENT_REQUEST', [
            'username' => $user->username,
            'amount' => getAmount($order->final_amount),
            'currency' => $basic->currency,
            'gateway' => $gateway->name,
            'date'    => $currentDate
        ]);

        session()->flash('success', 'You request has been taken.');
        return redirect()->route('user.home');
    }

    public function gatewayIpn(Request $request, $code, $trx = null, $type = null) //extra
    {
        if (isset($request->m_orderid)) {
            $trx  = $request->m_orderid;
        }

        //extra coinbasecommerce

        try {
            $gateway = Gateway::where('code', $code)->first();

            $basic = (object) config('basic');
            $order = (object) $request->order;
            $user = auth()->user();
            $charge = getAmount($gateway->fixed_charge + ($order->final_amount * $gateway->percentage_charge / 100));
            $remarks = 'Invested On Properties';

            /* dd($user->id);
            die; */

            if (!$gateway) throw new \Exception('Invalid Payment Gateway.');
            if (isset($trx)) {
                //$order = Fund::where('transaction', $trx)->orderBy('id','desc')->with(['gateway','user'])->first();
                //$order = Investment::where('transaction', $trx)->orderBy('id','desc')->with(['gateway', 'user'])->first();
                //if (!$order) throw new \Exception( 'Invalid Payment Request.');
            }
            $getwayObj = 'App\\Services\\Gateway\\' . $code . '\\Payment';
            $data = $getwayObj::ipn($request, $gateway, @$order, @$trx, @$type);
            if ($data['status'] == "success") {
                BasicService::makeTransaction($user, $order->final_amount, $charge, '+', 'balance', $trx, $remarks);

                $profit = 0;

                foreach ($request->investments_id as $key => $id) {
                    $myInvest = Investment::findOrFail($id);
                    $myInvest->amount = $request->investments_amount[$key];
                    $myInvest->is_active = 1;
                    $myInvest->gateway_id = $gateway->id;
                    $myInvest->gateway_currency = strtoupper($gateway->currency);
                    $myInvest->charge = 0;
                    $myInvest->rate = $gateway->convention_rate;
                    $myInvest->final_amount = $myInvest->amount;
                    $myInvest->btc_amount = 0;
                    $myInvest->btc_wallet = "";
                    $myInvest->transaction = $trx;
                    $myInvest->try = 0;
                    $myInvest->payment_status = 1;
                    $myInvest->status = 1; // complete
                    $myInvest->card_quantity = $myInvest->card_quantity + $request->investments_card_quantity[$key];

                    $myInvest->save();

                    $profit += $myInvest->profit;
                }


                $user->balance += getAmount($order->final_amount);
                $user->interest_balance += $profit;
                $user->total_invest += getAmount($order->final_amount);
                $user->total_deposit += getAmount($order->final_amount);
                $user->save();
            }


            $msg = [
                'username' => $user->username,
                'amount' => getAmount($order->final_amount),
                'currency' => $basic->currency,
                'gateway' => $gateway->name
            ];
            $action = [
                "link" => route('admin.payment.pending', $user->id),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $currentDate = dateTime(Carbon::now());
            $this->adminPushNotification('ADMIN_NOTIFY_PAYMENT_REQUEST', $msg, $action);
            $this->mailToAdmin($type = 'ADMIN_MAIL_PAYMENT_REQUEST', [
                'username' => $user->username,
                'amount' => getAmount($order->final_amount),
                'currency' => $basic->currency,
                'gateway' => $gateway->name,
                'date' => $currentDate
            ]);

            $userAction = [
                "link" => route('user.fund-history'),
                "icon" => "fa fa-money-bill-alt text-white"
            ];

            $this->userPushNotification($user, 'USER_NOTIFY_PAYMENT_REQUEST', $msg, $userAction);
            $this->sendMailSms($user, 'USER_MAIL_PAYMENT_REQUEST', [
                'username' => $user->username,
                'amount' => getAmount($order->final_amount),
                'currency' => $basic->currency,
                'gateway' => $gateway->name,
                'date'    => $currentDate
            ]);


            if (isset($data['redirect'])) {
                return redirect($data['redirect'])->with($data['status'], $data['msg']);
            }
        } catch (\Exception $exception) {
            //return dd($exception);
            //return back()->with('error', $exception->getMessage());
            session()->flash('error', $exception->getMessage());
            //return redirect()->route('user.invest-property-cart');
        }
    }

    public function success()
    {
        //return redirect()->route('user.fund-history')->with('success', 'Successfully Deposit');
        session()->flash('success', 'Property Cards Purchased');
        return redirect()->route('user.home');
    }

    public function failed()
    {
        return view('failed');
    }

    /**
     * @param Request $request
     * @param $user
     * @param $gate
     * @param $charge
     * @param $final_amo
     * @return Fund
     * @return $amount
     * @return $plan_id
     */
    public function newFund(Request $request, $user, $gate, $charge, $final_amo, $amount): Fund
    {
        $fund = new Fund();
        $fund->user_id = $user->id;
        $fund->gateway_id = $gate->id;
        $fund->gateway_currency = strtoupper($gate->currency);
        $fund->amount = $amount;
        $fund->charge = $charge;
        $fund->rate = $gate->convention_rate;
        $fund->final_amount = getAmount($final_amo);
        $fund->btc_amount = 0;
        $fund->btc_wallet = "";
        $fund->transaction = strRandom();
        $fund->try = 0;
        $fund->status = 0;
        $fund->save();
        return $fund;
    }
}
