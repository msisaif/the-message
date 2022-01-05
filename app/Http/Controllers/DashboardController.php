<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Sura;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'count' => [
                'admin' => User::onlyAdmin()->count(),
                'user'  => User::onlyUser()->count(),
                'sura'  => Sura::count(),
                'post'  => Post::count(),
            ] 
        ]);
    }
}
