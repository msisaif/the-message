<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Index', [
            'posts' => Post::latest()->take(100)->get(),
            'videos' => Video::latest()->type(1)->simplePaginate(6)
        ]);
    }
}
