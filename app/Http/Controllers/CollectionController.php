<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\CollectionImport;
use App\Models\Ayah;
use App\Models\Juz;
use App\Models\Sura;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class CollectionController extends Controller
{
    public function apiToSql($option = null)
    {
        if($option === 'juz') {
            return $this->apiToJuzStore();
        }

        if($option === 'ayah') {
            return $this->apiToAyahStore();
        }

        if($option === 'sura') {
            return $this->apiToSuraStore();
        }

        return "
            <ul>
                <li><a href='/quran-api/juz'>juz insert from api</a></li>
                <li><a href='/quran-api/ayah'>ayah insert from api</a></li>
                <li><a href='/quran-api/sura'>sura insert from api</a></li>
            </ul>
        ";
    }

    public function apiToJuzStore()
    {
        if(Juz::count()) {
            return;
        }

        $response = Http::get('https://api.quran.com/api/v4/juzs');

        $collection = $response->object()->juzs;

        // dd($collection);

        $data = [];

        foreach($collection as $item) {

            // dd($item);

            $data[] = [
                "juz_number"    => $item->juz_number,
                "first_ayah"    => $item->first_verse_id,
                "last_ayah"     => $item->last_verse_id,
                "total_ayah"    => $item->verses_count,
            ];
        }

        dd($data);

        return Juz::insert($data);
    }

    public function apiToSuraStore()
    {
        if(Sura::count()) {
            return;
        }

        // https://api.quran.com/api/v4/chapters?language=bn

        $response = Http::get('https://api.quran.com/api/v4/chapters');

        $response_bn = Http::get('https://api.quran.com/api/v4/chapters?language=bn');

        $collection = $response->object()->chapters;
        
        $collection_bn = $response_bn->object()->chapters;
    
        // dd($collection);

        // dd($collection_bn);

        $revelation_place = [
            "makkah" => 1,
            "madinah" => 2,
        ];

        $data = [];

        foreach($collection as $index => $item) {

            // dd($item);

            $data[] = [
                "sura_number"           => $item->id,
                "total_ayah"            => $item->verses_count,
                "bismillah_pre"         => $item->bismillah_pre ? 1 : 0,
                "revelation_place"      => $revelation_place[$item->revelation_place],
                "revelation_order"      => $item->revelation_order,
                "arabic"                => $item->name_arabic,
                "bengali_meaning"       => $collection_bn[$index]->translated_name->name,
                // "bengali_pronunciation" => null,
                "english_meaning"       => $item->translated_name->name,
                "english_pronunciation" => $item->name_simple,
            ];
        }

        dd($data);

        return Sura::insert($data);
    }

    public function apiToAyahStore()
    {
        if(Ayah::count()) {
            return;
        }

        $response = Http::get('https://api.quran.com/api/v4/quran/verses/indopak');

        $collection = $response->object()->verses;

        // dd($collection);

        $data = [];

        $juzs = Juz::pluck('id', 'first_ayah');

        // dd($juzs);

        $juz = 0;

        foreach($collection as $item) {

            // dd($item);

            $data[] = [
                "sura_number"   => explode(":", $item->verse_key)[0],
                "position"      => explode(":", $item->verse_key)[1],
                "key"           => $item->verse_key,
                "text"          => $item->text_indopak,
                "ayah_number"   => $item->id,
                "juz_number"    => isset($juzs[$item->id]) ? $juz = $juzs[$item->id] : $juz
            ];
        }

        // dd($data);

        return Ayah::insert($data);
    }

    public function create()
    {
        return Inertia::render('Import/Form');
    }

    public function store(Request $request)
    {
        return $request;

        Excel::import(new CollectionImport(), $request->file);

        return 'Success!';
    }
}
