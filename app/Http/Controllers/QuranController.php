<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AyahResource;
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
            ->with('ayahs','suras')
            ->orderBy('juz_number')
            ->get();

        return Inertia::render('Quran/Index', [
            'suras' => SuraResource::collection($suras),
            'juzs'  => JuzResource::collection($juzs),
        ]);
    }

    public function sura(Sura $sura, $range = null)
    {
        $from = explode("-", $range)[0] ?? null;
        $to = explode("-", $range)[1] ?? null;

        $ayahs = $sura
            ->ayahs()
            ->when($from, function($query, $from) {
                $query->where('ayah_number', '>=', $from);
            })
            ->when($to, function($query, $to) {
                $query->where('ayah_number', '<=', $to);
            })
            ->get();

        AyahResource::withoutWrapping();

        return Inertia::render('Quran/Show', [
            'ayahs' => AyahResource::collection($ayahs),
            'bismillahPre' => (boolean) $sura->bismillah_pre,
        ]);
    }
}
