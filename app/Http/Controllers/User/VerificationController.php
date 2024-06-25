<?php

namespace App\Http\Controllers\User;

use App\Helper\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller
{

    use Notify;

    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });

        $this->theme = template();
    }

    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->sent_at) return false;
        if ($user->sent_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->verify_code !== $code) return false;
        return true;
    }
    public function check()
    {
        $user = $this->user;
        /* dd($user);
        die; */

        if (!$user->status) {
            Auth::logout();
        } elseif (!$user->email_verification) {

            if (!$this->checkValidCode($user, $user->verify_code)) {
                $user->verify_code = code(6);
                $user->sent_at = Carbon::now();
                $user->save();
                $this->mailVerification($user, 'VERIFICATION_CODE', [ //extra
                    'code' => $user->verify_code,
                    'user' => $user->fullname
                ]);
                session()->flash('success', 'Email verification code has been sent');
            }
            $templateSection = ['news-letter'];
            $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
            $page_title = 'Email Verification';
            return view(template() . 'auth.verification.email', $data, compact('user', 'page_title'));
        } elseif (!$user->sms_verification) {
            if (!$this->checkValidCode($user, $user->verify_code)) {
                $user->verify_code = code(6);
                $user->sent_at = Carbon::now();
                $user->save();

                $this->smsVerification($user, 'VERIFICATION_CODE', [
                    'code' => $user->verify_code
                ]);
                session()->flash('success', 'SMS verification code has been sent');
            }
            $templateSection = ['news-letter'];
            $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
            $page_title = 'SMS Verification';
            return view(template() . 'auth.verification.sms', $data, compact('user', 'page_title'));
        } elseif (!$user->two_fa_verify) {
            $templateSection = ['news-letter'];
            $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
            $page_title = '2FA Code';
            return view(template() . 'auth.verification.2stepSecurity', $data, compact('user', 'page_title'));
        }
        return redirect()->route('user.home');
    }


    public function resendCode()
    {

        $type = request()->type;
        $user  = $this->user;
        if ($this->checkValidCode($user, $user->verify_code, 2)) {
            $target_time = $user->sent_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();

            throw ValidationException::withMessages(['resend' => 'Please Try after ' . gmdate("i:s", $delay) . ' minutes']);
        }
        if (!$this->checkValidCode($user, $user->verify_code)) {
            $user->verify_code = code(6);
            $user->sent_at = Carbon::now();
            $user->save();
        } else {
            $user->sent_at = Carbon::now();
            $user->save();
        }


        if ($type === 'email') {
            $this->mailVerification($user, 'VERIFICATION_CODE', [
                'code' => $user->verify_code,
                'user' => $user->fullname
            ]);

            return back()->with('success', 'Email verification code has been sent');
        } elseif ($type === 'mobile') {
            $this->smsVerification($user, 'VERIFICATION_CODE', [
                'code' => $user->verify_code
            ]);
            return back()->with('success', 'SMS verification code has been sent');
        } else {
            throw ValidationException::withMessages(['error' => 'Sending Failed']);
        }
    }

    public function mailVerify(Request $request)
    {
        $rules = [
            'code' => 'required',
        ];
        $msg = [
            'code.required' => 'Email verification code is required',
        ];
        $validate = $this->validate($request, $rules, $msg);
        $user = $this->user;

        if ($this->checkValidCode($user, $request->code)) {

            $currentDate = dateTime(Carbon::now()); //extra moved from register
            $this->sendMailSms($user, $type = 'REGISTER_CONFIRM_MAIL_TO_USER', [
                'name'          => $user->fullname,
                'date'          => $currentDate,
            ]);

            $user->email_verification = 1;
            $user->verify_code = null;
            $user->sent_at = null;
            $user->save();

            if ($user->phone === "0123456789") { //extra
                return redirect()->intended(route('thank.you'));
            } else {
                return redirect()->intended(route('user.home'));
            }
            
        }
        throw ValidationException::withMessages(['error' => 'Verification code didn\'t match!']);
    }

    public function smsVerify(Request $request)
    {
        $rules = [
            'code' => 'required',
        ];
        $msg = [
            'code.required' => 'Email verification code is required',
        ];
        $validate = $this->validate($request, $rules, $msg);
        $user = Auth::user();

        if ($this->checkValidCode($user, $request->code)) {
            $user->sms_verification = 1;
            $user->verify_code = null;
            $user->sent_at = null;
            $user->save();

            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['error' => 'Verification code didn\'t match!']);
    }

    public function twoFAverify(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ], [
            'code.required' => 'Email verification code is required',
        ]);
        $ga = new GoogleAuthenticator();
        $user = Auth::user();
        $getCode = $ga->getCode($user->two_fa_code);
        if ($getCode == trim($request->code)) {
            $user->two_fa_verify = 1;
            $user->save();
            return redirect()->intended(route('user.home'));
        }
        throw ValidationException::withMessages(['error' => 'Wrong Verification Code']);
    }
}
