<?php

namespace App\Http\Controllers\Admin;

use App\Models\Badge;
use App\Models\KYC;
use App\Models\User;
use App\Models\Language;
use App\Models\PayoutLog;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    use Upload, Notify;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::with('userBadge.details')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.users.list', compact('users'));
    }


    public function userStore(Request $request)
    {
        $reqData = Purify::clean($request->except('_token', '_method'));
        // validation start
        $rules = [
            'password' => 'required|min:6|confirmed',
            'firstname' => 'required', 'string', 'max:91',
            'lastname' => 'required', 'string', 'max:91',
            'username' => 'required', 'alpha_dash', 'min:5', 'unique:users,username',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users,email',
            'country_code' => 'max:5',
            'phone_code' => 'required'
        ];

        $message = [
            'firstname.required' => 'First Name Field is required',
            'lastname.required' => 'Last Name Field is required',
        ];

        $validate = Validator::make($reqData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $basic = (object)config('basic');
        User::create([
            'firstname' => $reqData['firstname'],
            'lastname' => $reqData['lastname'],
            'username' => $reqData['username'],
            'email' => $reqData['email'],
            'referral_id' => null,
            'country_code' => $reqData['country_code'],
            'phone_code' => $reqData['phone_code'],
            'phone' => $reqData['phone'],
            'password' => Hash::make($reqData['password']),
            'email_verification' => ($basic->email_verification) ? 0 : 1,
            'sms_verification' => ($basic->sms_verification) ? 0 : 1,
            'premium_user' => 1,
        ]);


        return back()->with('success', 'User created successfully!');

    }

    public function search(Request $request)
    {
        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $users = User::when(isset($search['user']), function ($query) use ($search) {
            return $query->where('id', $search['user']);
        })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate, $toDate) {
                return $q2->whereBetween('created_at', [$fromDate, $toDate]);
            })
            ->paginate(config('basic.paginate'));
        return view('admin.users.list', compact('users', 'search'));
    }


    public function activeMultiple(Request $request)
    {
        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User.');
            return response()->json(['error' => 1]);
        } else {
            User::whereIn('id', $request->strIds)->update([
                'status' => 1,
            ]);
            session()->flash('success', 'User Status Has Been Active');
            return response()->json(['success' => 1]);
        }
    }

    public function inactiveMultiple(Request $request)
    {

        if ($request->strIds == null) {
            session()->flash('error', 'You do not select User.');
            return response()->json(['error' => 1]);
        } else {
            User::whereIn('id', $request->strIds)->update([
                'status' => 0,
            ]);

            session()->flash('success', 'User Status Has Been Deactive');
            return response()->json(['success' => 1]);

        }
    }


    public function userEdit($id)
    {
        $user = User::with('userBadge.details')->findOrFail($id);
        $data['allBadges'] = Badge::with('details')->where('status', 1)->orderBy('sort_by', 'ASC')->get();
        $languages = Language::all();
        return view('admin.users.edit-user', $data, compact('user', 'languages'));
    }

    public function userUpdate(Request $request, $id)
    {
        $languages = Language::all()->map(function ($item) {
            return $item->id;
        });
        $userData = Purify::clean($request->except('_token', '_method'));
        $user = User::findOrFail($id);
        $rules = [
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'username' => 'sometimes|required|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'language_id' => Rule::in($languages),
        ];
        $message = [
            'firstname.required' => 'First Name is required',
            'lastname.required' => 'Last Name is required',
        ];

        $Validator = Validator::make($userData, $rules, $message);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = $this->uploadImage($request->image, config('location.user.path'), config('location.user.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->phone = $userData['phone'];
        $user->language_id = $userData['language_id'];
        $user->address = $userData['address'];
        $user->status = ($userData['status'] == 'on') ? 0 : 1;
        $user->email_verification = ($userData['email_verification'] == 'on') ? 0 : 1;
        $user->sms_verification = ($userData['sms_verification'] == 'on') ? 0 : 1;
        $user->two_fa_verify = ($userData['two_fa_verify'] == 'on') ? 1 : 0;
        $user->save();

        $msg = [
            'user_name' => $user->fullname,
        ];

        $adminAction = [
            "link" => route('admin.user-edit', $user->id),
            "icon" => "fas fa-user text-white"
        ];

        $userAction = [
            "link" => route('user.profile'),
            "icon" => "fas fa-user text-white"
        ];

        $this->adminPushNotification('ADMIN_NOTIFY_WHEN_ADMIN_USER_UPDATE', $msg, $adminAction);
        $this->userPushNotification($user, 'USER_NOTIFY_WHEN_ADMIN_PROFILE_UPDATE', $msg, $userAction);

        $currentDate = dateTime(Carbon::now());
        $this->sendMailSms($user, $type = 'ADMIN_MAIL_WHEN_ADMIN_USER_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);

        $this->mailToAdmin($type = 'USER_MAIL_WHEN_ADMIN_PROFILE_UPDATE', [
            'name' => $user->fullname,
            'date' => $currentDate,
        ]);

        return back()->with('success', 'Updated Successfully.');
    }

    public function passwordUpdate(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:5|same:password_confirmation',
        ]);
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        $this->sendMailSms($user, 'PASSWORD_CHANGED', [
            'password' => $request->password
        ]);

        return back()->with('success', 'Updated Successfully.');
    }

    public function userBalanceUpdate(Request $request, $id)
    {
        $userData = Purify::clean($request->all());

        if ($userData['balance'] == null) {
            return back()->with('error', 'Balance Value Empty!');
        } else {
            $control = (object)config('basic');
            $user = User::findOrFail($id);
            if ($userData['walet'] == 'main_balance') {
                if ($userData['add_status'] == "1") {
                    $user->balance += $userData['balance'];
                    $user->save();

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '+';
                    $transaction->amount = $userData['balance'];
                    $transaction->charge = 0;
                    $transaction->remarks = 'Add Balance';
                    $transaction->trx_id = strRandom();
                    $transaction->save();


                    $msg = [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->userPushNotification($user, 'ADD_BALANCE', $msg, $action);


                    $this->sendMailSms($user, 'ADD_BALANCE', [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ]);

                    return back()->with('success', 'Balance Add Successfully.');

                } else {

                    if ($userData['balance'] > $user->balance) {
                        return back()->with('error', 'Insufficient Balance to deducted.');
                    }
                    $user->balance -= $userData['balance'];
                    $user->save();


                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '-';
                    $transaction->amount = $userData['balance'];
                    $transaction->charge = 0;
                    $transaction->remarks = 'Deducted Balance';
                    $transaction->trx_id = strRandom();
                    $transaction->save();


                    $msg = [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->userPushNotification($user, 'DEDUCTED_BALANCE', $msg, $action);

                    $this->sendMailSms($user, 'DEDUCTED_BALANCE', [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id,
                    ]);
                    return back()->with('success', 'Balance deducted Successfully.');
                }
            } else {

                if ($userData['add_status'] == "1") {
                    $user->interest_balance += $userData['balance'];
                    $user->save();

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '+';
                    $transaction->amount = $userData['balance'];
                    $transaction->charge = 0;
                    $transaction->remarks = 'Add Balance';
                    $transaction->trx_id = strRandom();
                    $transaction->save();


                    $msg = [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->userPushNotification($user, 'ADD_BALANCE', $msg, $action);


                    $this->sendMailSms($user, 'ADD_BALANCE', [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ]);

                    return back()->with('success', 'Balance Add Successfully.');

                } else {

                    if ($userData['balance'] > $user->balance) {
                        return back()->with('error', 'Insufficient Balance to deducted.');
                    }
                    $user->interest_balance -= $userData['balance'];
                    $user->save();


                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '-';
                    $transaction->amount = $userData['balance'];
                    $transaction->charge = 0;
                    $transaction->remarks = 'Deducted Balance';
                    $transaction->trx_id = strRandom();
                    $transaction->save();


                    $msg = [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id
                    ];
                    $action = [
                        "link" => '#',
                        "icon" => "fa fa-money-bill-alt text-white"
                    ];

                    $this->userPushNotification($user, 'DEDUCTED_BALANCE', $msg, $action);

                    $this->sendMailSms($user, 'DEDUCTED_BALANCE', [
                        'amount' => getAmount($userData['balance']),
                        'currency' => $control->currency,
                        'main_balance' => $user->balance,
                        'transaction' => $transaction->trx_id,
                    ]);
                    return back()->with('success', 'Balance deducted Successfully.');
                }

            }
        }
    }


    public function emailToUsers()
    {
        return view('admin.users.mail-form');
    }

    public function sendEmailToUsers(Request $request)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'subject' => 'sometimes|required',
            'message' => 'sometimes|required'
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $allUsers = User::where('status', 1)->get();
        foreach ($allUsers as $user) {
            $this->mail($user, null, [], $req['subject'], $req['message']);
        }


        return back()->with('success', 'Mail Send Successfully');
    }


    public function sendEmail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.single-mail-form', compact('user'));
    }

    public function sendMailUser(Request $request, $id)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'subject' => 'sometimes|required',
            'message' => 'sometimes|required'
        ];
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $this->mail($user, null, [], $req['subject'], $req['message']);

        return back()->with('success', 'Mail Send Successfully');
    }


    public function transaction($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $transaction = $user->transaction()->paginate(config('basic.paginate'));
        return view('admin.users.transactions', compact('user', 'userid', 'transaction'));
    }

    public function funds($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $funds = $user->funds()->paginate(config('basic.paginate'));
        return view('admin.users.fund-log', compact('user', 'userid', 'funds'));
    }

    public function investments($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $investments = $user->invests()->paginate(config('basic.paginate'));
        return view('admin.users.investments', compact('user', 'userid', 'investments'));
    }

    public function payoutLog($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $records = PayoutLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->with('user', 'method')->paginate(config('basic.paginate'));
        return view('admin.users.payout-log', compact('user', 'userid', 'records'));
    }

    public function commissionLog($id)
    {
        $user = User::findOrFail($id);
        $userid = $user->id;
        $transactions = $user->referralBonusLog()->latest()->with('user', 'bonusBy:id,firstname,lastname')->paginate(config('basic.paginate'));
        return view('admin.users.commissionLog', compact('user', 'userid', 'transactions'));
    }

    public function referralMember($id)
    {
        $user = User::findOrFail($id);
        $referrals = getLevelUser($user->id);
        return view('admin.users.referral', compact('user', 'referrals'));
    }

    public function loginAsUser(Request $request, $id)
    {
        Auth::guard('web')->loginUsingId($id);
        return redirect()->route('user.home');
    }


    public function kycPendingList()
    {
        $title = "Pending KYC";
        $logs = KYC::orderBy('id', 'DESC')->where('status', 0)->with(['user', 'admin'])->paginate(config('basic.paginate'));
        return view('admin.users.kycList', compact('logs', 'title'));
    }

    public function kycList()
    {
        $title = "KYC Log";
        $logs = KYC::orderBy('id', 'DESC')->where('status', '!=', 0)->paginate(config('basic.paginate'));
        return view('admin.users.kycList', compact('logs', 'title'));
    }

    public function userKycHistory(User $user)
    {
        $title = $user->username . " : KYC Log";
        $logs = KYC::orderBy('id', 'DESC')->where('user_id', $user->id)->paginate(config('basic.paginate'));
        return view('admin.users.kycList', compact('logs', 'title'));
    }


    public function kycAction(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'status' => ['required', Rule::in(['1', '2'])],
        ]);
        $data = KYC::where('id', $request->id)->whereIn('status', [0])->with('user')->firstOrFail();
        $basic = (object)config('basic');

        if ($request->status == '1') {
            $data->status = 1;
            $data->admin_id = auth()->guard('admin')->id();
            $data->update();
            $user = $data->user;
            if ($data->kyc_type == 'address-verification') {
                $user->address_verify = 2;
            } else {
                $user->identity_verify = 2;
            }
            $user->save();

            $userMsg = [
                'kyc_type' => kebab2Title($data->kyc_type)
            ];

            $adminMsg = [
                'user_name' => $user->fullname,
                'kyc_type' => kebab2Title($data->kyc_type)
            ];

            $adminAction = [
                "link" => route('admin.kyc.users'),
                "icon" => "fas fa-file-alt text-white"
            ];

            $userAction = [
                "link" => '#',
                "icon" => "fas fa-file-alt text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_KYC_APPROVED', $adminMsg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_KYC_APPROVED', $userMsg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_KYC_APPROVED', [
                'kyc_type' => kebab2Title($data->kyc_type),
                'date' => $currentDate
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_KYC_APPROVED', [
                'user_name' => $user->fullname,
                'kyc_type' => kebab2Title($data->kyc_type),
                'date' => $currentDate
            ]);

            session()->flash('success', 'Approve Successfully');
            return back();

        } elseif ($request->status == '2') {
            $data->status = 2;
            $data->admin_id = auth()->guard('admin')->id();
            $data->update();

            $user = $data->user;
            if ($data->kyc_type == 'address-verification') {
                $user->address_verify = 3;
            } else {
                $user->identity_verify = 3;
            }
            $user->save();

            $userMsg = [
                'kyc_type' => kebab2Title($data->kyc_type)
            ];

            $adminMsg = [
                'user_name' => $user->fullname,
                'kyc_type' => kebab2Title($data->kyc_type)
            ];

            $adminAction = [
                "link" => route('admin.kyc.users'),
                "icon" => "fas fa-file-alt text-white"
            ];

            $userAction = [
                "link" => '#',
                "icon" => "fas fa-file-alt text-white"
            ];

            $this->adminPushNotification('ADMIN_NOTIFY_KYC_REJECTED', $adminMsg, $adminAction);
            $this->userPushNotification($user, 'USER_NOTIFY_KYC_REJECTED', $userMsg, $userAction);

            $currentDate = dateTime(Carbon::now());
            $this->sendMailSms($user, $type = 'USER_MAIL_KYC_REJECTED', [
                'kyc_type' => kebab2Title($data->kyc_type),
                'date' => $currentDate
            ]);

            $this->mailToAdmin($type = 'ADMIN_MAIL_KYC_REJECTED', [
                'user_name' => $user->fullname,
                'kyc_type' => kebab2Title($data->kyc_type),
                'date' => $currentDate
            ]);

            session()->flash('success', 'Reject Successfully');
            return back();
        }
    }


}
