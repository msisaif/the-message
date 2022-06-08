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
        return Inertia::render('Auth/Join');
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

        $data = [
            "phone" => $user->phone ?? $phone,
            "name"  => $user->name ?? '',
        ];

        return redirect()->route('login', $data);
    }
}
