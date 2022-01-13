<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SuraResource;
use App\Models\Juz;
use App\Models\Sura;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuranController extends Controller
{
    public function index()
    {
        SuraResource::withoutWrapping();
        JuzResource::withoutWrapping();

        $suras = Sura::query()
            ->orderBy('sura_number')
            ->get();

        $juzs = Juz::query()
            ->with('suras')
            ->orderBy('juz_number')
            ->get();

        return Inertia::render('Quran/Index', [
            'suras' => SuraResource::collection($suras),
            'juzs'  => JuzResource::collection($juzs),
        ]);
    }
}
