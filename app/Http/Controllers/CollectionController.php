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

        if($option === 'word') {
            return $this->apiToWordStore();
        }

        return "
            <ul>
                <li><a href='/quran-api/juz'>juz insert from api</a></li>
                <li><a href='/quran-api/sura'>sura insert from api</a></li>
                <li><a href='/quran-api/ayah'>ayah insert from api</a></li>
                <li><a href='/quran-api/word'>word testing</a></li>
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

        $response2 = Http::get('https://api.quran.com/api/v4/quran/verses/code_v2');

        $collection = $response->object()->verses;

        $collection2 = $response2->object()->verses;

        // dd($collection);

        // dd($collection2);

        $data = [];

        $juzs = Juz::pluck('id', 'first_ayah');

        $sajdah = [
            "7:206",
            "13:15",
            "16:50",
            "17:109",
            "19:58",
            "22:18",
            "22:77",
            "25:60",
            "27:26",
            "32:15",
            "38:24",
            "41:38",
            "53:62",
            "84:21",
            "96:19",
        ];

        // dd($juzs);

        $juz = 0;

        foreach($collection as $index => $item) {

            // dd($item);

            // dd($collection2[$index]);

            $data[] = [
                "sura_number"   => explode(":", $item->verse_key)[0],
                "position"      => explode(":", $item->verse_key)[1],
                "key"           => $item->verse_key,
                "text"          => $item->text_indopak,
                "ayah_number"   => $item->id,
                "sajdah"        => in_array($item->verse_key, $sajdah) ? 1 : 0,
                "page_number"   => $collection2[$index]->v2_page,
                "juz_number"    => isset($juzs[$item->id]) ? $juz = $juzs[$item->id] : $juz
            ];
        }

        dd($data);

        return Ayah::insert($data);
    }
    
    public function apiToWordStore()
    {
        // dd(313);

        $ayahs = Ayah::query()
            ->whereIn('key', ["1:7"])
            ->get();

        foreach($ayahs as $ayah)
        {
            // dd($ayah->text); // ۙ‏ //

            $words = explode(" ", $ayah->text);

            dd($words);
        }
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
