<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AyahResource;
use App\Http\Resources\ClassificationResource;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SuraResource;
use App\Models\Classification;
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
        $ayahs = $sura
            ->ayahs()
            ->with('translations')
            ->when($range, function($query, $range) {
                $from = $to = 0;
                $query->when(str_contains($range, '-'), function($query) use ($range) {

                    $from = explode("-", $range)[0] ?? null;
                    $to = explode("-", $range)[1] ?? null;

                    $query
                        ->when($from, function($query, $from) {
                            $query->where('position', '>=', $from);
                        })
                        ->when($to, function($query, $to) {
                            $query->where('position', '<=', $to);
                        });
                }, function($query) use ($range) {
                    $query->where('position', $range);
                });
            })
            ->get();

        $classifications = Classification::query()
            ->where('sura_number', $sura->sura_number)
            ->get();

        AyahResource::withoutWrapping();
        ClassificationResource::withoutWrapping();
        SuraResource::withoutWrapping();

        return Inertia::render('Quran/Show', [
            'ayahs' => AyahResource::collection($ayahs),
            'bismillahPre' => (boolean) $sura->bismillah_pre,
            'classifications' => ClassificationResource::collection($classifications),
            'resources' => [1, 3, 13],
            'sura' => new SuraResource($sura),
            'show' => in_array(request()->option, ['classification', 'read', 'translations']) ? request()->option : 'translations',
        ]);
    }
}
