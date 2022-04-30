<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecentVideoController extends Controller
{
    public function index()
    {
        return Inertia::render('RecentVideo/Index', [
            'videos' => Video::latest()->type(1)->simplePaginate(8)
        ]);
    }
}
