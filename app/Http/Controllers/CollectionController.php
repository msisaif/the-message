<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\CollectionImport;
use App\Models\Ayah;
use App\Models\Juz;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class CollectionController extends Controller
{
    public function create()
    {

        $response = Http::withHeaders([
            "Content-Type" => "text/html; charset=utf-8"
        ])->get('https://api.quran.com/api/v4/quran/verses/indopak');

        $collection = $response->object()->verses;

        $data = [];

        $juzs = Juz::pluck('id', 'first_ayah');

        // dd($juzs);

        $juz = 0;

        foreach($collection as $item) {
            // dd($item->id);
            $data[] = [
                "sura_number" => explode(":", $item->verse_key)[0],
                "position" => explode(":", $item->verse_key)[1],
                "key" => $item->verse_key,
                "text" => $item->text_indopak,
                "ayah_number" => $item->id,
                "juz_number" => isset($juzs[$item->id]) ? $juz = $juzs[$item->id] : $juz
            ];
        }

        dd($data);

        return Ayah::insert($data);

        return Inertia::render('Import/Form');
    }

    public function store(Request $request)
    {
        // return 313;
        // return $request;

        Excel::import(new CollectionImport(), $request->file);

        return 'Success!';
    }
}
