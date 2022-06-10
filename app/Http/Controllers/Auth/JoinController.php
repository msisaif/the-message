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
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'      => '',
            'phone'     => 'required|numeric',
            'password'  => '',
        ]);

        $name       = $fields["name"];
        $phone      = $fields["phone"];
        $password   = $fields["password"];
        
        $message = "";
        $step = 2;

        $user = User::query()
            ->where('phone', $phone)
            ->first();

        if(!$user) {
            $password = rand(1111, 9999);

            $user = User::create([
                'phone'     => $phone,
                'password'  => $password,
            ]);

            $text = "আপনার পাসওয়ার্ড {$password}";
            $numbers = "88{$phone}";

            $this->sendSms($numbers, $text);

            $message = "আপনার মোবাইল নাম্বারে SMS এর মাধ্যমে পাসওয়ার্ড পাঠানো হয়েছে।";

            $step = 3;
        }

        if($user && $password) {
            if($user->security == $password) {
                Auth::login($user, 1);

                if($step == 3) {
                    $user->update([
                        'name'  => $name,
                    ]);
                }

                //session()->forget(['__phone', '__name', '__step', '__message']);

                return redirect()->intended(RouteServiceProvider::HOME);
            }

            $message = "আপনার পাসওয়ার্ড ভুল হয়েছে!";
        }

        session()->flash('__phone', $phone);
        session()->flash('__name', $user->name ?? '');
        session()->flash('__step', $step);
        session()->flash('__message', $message);

        return redirect()->route('join');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
