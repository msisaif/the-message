<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuraResource;
use App\Models\Sura;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuranController extends Controller
{
    public function index()
    {
        SuraResource::withoutWrapping();

        return Inertia::render('Quran/Index', [
            'suras' => SuraResource::collection(Sura::get()),
        ]);
    }
}
