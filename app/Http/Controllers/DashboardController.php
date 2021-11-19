<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'adminCount'   => User::onlyAdmin()->count(),
            'userCount'  => User::onlyUser()->count(),
        ]);
    }
}
