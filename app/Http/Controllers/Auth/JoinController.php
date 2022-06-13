<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class JoinController extends Controller
{
    public function create()
    {

        return Inertia::render('Auth/Join', [
            'phone'     => session('__phone'),
            'name'      => session('__name'),
            'step'      => session('__step', 1),
            'message'   => session('__message'),
            'sms'       => session('__sms', false),
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'      => '',
            'phone'     => 'required|numeric',
            'password'  => '',
            'step'      => 'required|numeric',
            'sms'       => '',
            'otp'       => '',
        ]);

        $name       = $fields["name"] ?? '';
        $phone      = $fields["phone"] ?? '';
        $password   = $fields["password"] ?? '';
        $step       = $fields["step"] ?? '';
        $sms        = $fields["sms"] ?? '';
        $otp        = $fields["otp"] ?? '';
    
        // return $step;

        if($step == 4) {
            $user = User::query()
                ->where('phone', $phone)
                ->first();

            $this->sendUserPassordBySms($user);

            session()->flash('__step', 2);

            $message = "আপনার মোবাইল নাম্বারে SMS এর মাধ্যমে পাসওয়ার্ড পাঠানো হয়েছে।";
        }

        if($step == 1) {
            $message = "";

            $user = User::query()
                ->where('phone', $phone)
                ->first();

            if($user) {
                session()->flash('__step', 2);
            } else {
                $otp = $this->sendOTP($phone);

                $message = "আপনার মোবাইল নাম্বারে SMS এর মাধ্যমে OTP পাঠানো হয়েছে।";

                session()->flash('__step', 3);
            }
            
            $name = $user->name ?? '';
        }

        if($step == 2) {
            $user = User::query()
                ->where([
                    'phone'     => $phone,
                    'password'  => $password,
                ])
                ->first();

            if($user) {
                Auth::login($user, 1);

                if($name && $user->name != $name) {
                    $user->update([
                        'name'  => $name,
                    ]);
                }

                session()->forget(['__name', '__phone', '__step', '__otp']);

                return redirect()->intended(RouteServiceProvider::HOME);
            }

            session()->flash('__step', 2);

            $message = "আপনার পাসওয়ার্ড ভুল হয়েছে!";
        }

        if($step == 3) {
            if($otp == session('__otp')) {
                session()->flash('__step', 5);

                $message = "নাম ও পাসওয়ার্ড দিয়ে এগিয়ে যান।";

            } else {
                session()->flash('__step', 3);
    
                $message = "আপনার কোড (OTP) ভুল হয়েছে!";
            }

            
        }

        if($step == 5) {
            if($otp == session('__otp')) {
                $user = User::create([
                    'name' => $name,
                    'password'  => $password,
                    'phone' => $phone,
                ]);

                Auth::login($user, 1);

                session()->forget(['__name', '__phone', '__step', '__otp']);

                return redirect()->intended(RouteServiceProvider::HOME);
            }

            session()->flash('__step', 3);

            $message = "আপনার কোড (OTP) ভুল হয়েছে!";
        }

        session()->flash('__phone', $phone);
        session()->flash('__name', $name);
        session()->flash('__message', $message);
        session()->flash('__sms', $sms);

        return redirect()->route('join');
    }

    public function destroy(Request $request)
    {
        unset(Auth::user()->avatar);
        unset(Auth::user()->firstLatter);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function sendOTP($phone)
    {
        $otp = rand(1111, 9999);

        $text = "আপনার কোড {$otp}";

        $numbers = "88{$phone}";

        $this->sendSms($numbers, $text);

        session()->put('__otp', $otp);

        return $otp;
    }

    protected function sendUserPassordBySms($user)
    {
        $text = "আপনার পাসওয়ার্ড {$user->password}";

        $numbers = "88{$user->phone}";

        $this->sendSms($numbers, $text);
    }

}
