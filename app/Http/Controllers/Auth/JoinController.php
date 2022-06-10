<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'status'    => session('status'),
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

        $user = User::query()
            ->where('phone', $phone)
            ->first();

        if($user && $password) {
            if($user->security == $password) {
                Auth::login($user, 1);

                return back();
            }

            return $message = "আপনার পাসওয়ার্ড ভুল হয়েছে!";
        }
        
        $message = "";

        $step = 2;

        if(!$user) {
            $password = rand(1111, 9999);

            $user = User::create([
                'phone'     => $phone,
                'password'  => $password,
            ]);

            $text = "আপনার পাসওয়ার্ড {$password}";

            $this->sendSms($phone, $text);

            $message = "আপনার মোবাইল নাম্বারে SMS এর মাধ্যমে পাসওয়ার্ড পাঠানো হয়েছে।";

            $step = 3;
        }


        session()->put('__phone', $phone);
        session()->put('__name', $user->name ?? '');
        session()->put('__step', $step);
        session()->flash('status', $message);

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
