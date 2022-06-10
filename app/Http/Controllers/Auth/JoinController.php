<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
            'phone' => 'required|numeric',
        ]);

        $phone = $fields["phone"];

        $user = User::query()
            ->where('phone', $phone)
            ->first();
        
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

}
