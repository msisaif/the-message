<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonateController extends Controller
{
    public function index()
    {
        return Inertia::render('Donate/Index');
    }
}
