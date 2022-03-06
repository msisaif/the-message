<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\CollectionImport;
use App\Models\Ayah;
use App\Models\Juz;
use App\Models\Resource;
use App\Models\Sura;
use App\Models\Translation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class CollectionController extends Controller
{
    public function apiToSql($option = null)
    {

        return 'ok';
        
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

        if($option === 'translations') {
            return $this->apiToTranslationsStore();
        }

        return "
            <ul>
                <li><a href='/quran-api/juz'>juz insert from api</a></li>
                <li><a href='/quran-api/sura'>sura insert from api</a></li>
                <li><a href='/quran-api/ayah'>ayah insert from api</a></li>
                <li><a href='/quran-api/word'>word testing</a></li>
                <li><a href='/quran-api/translations'>translations</a></li>
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

        // dd($data);

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

        $bengali_pronunciations = [
            "আল ফাতিহা",
            "আল বাক্বারাহ",
            "আল ইমরান",
            "আন নিসা",
            "আল মায়েদাহ",
            "আল আন-আম",
            "আল আ’রাফ",
            "আল-আনফাল",
            "আত তাওবাহ",
            "ইউনুস",
            "হুদ",
            "ইউসূফ",
            "রা’দ",
            "ইব্রাহীম",
            "হিজর",
            "নাহল",
            "বনী ইসরাঈল",
            "কাহফ",
            "মারইয়াম",
            "ত্বোয়া-হা",
            "আম্বিয়া",
            "হাজ্জ্ব",
            "আল মু’মিনূন",
            "আন-নূর",
            "আল-ফুরকান",
            "আশ-শো'আরা",
            "নমল",
            "আল কাসাস",
            "আল আনকাবুত",
            "আর-রূম",
            "লুকমান",
            "সেজদাহ",
            "আল আহযাব",
            "সাবা",
            "ফাতির",
            "ইয়াসীন",
            "আস-সাফফাত",
            "ছোয়াদ",
            "আল-যুমার",
            "আল মু'মিন",
            "হা-মীম সেজদাহ্‌",
            "আশ্‌-শূরা",
            "আয্‌-যুখরুফ",
            "আদ-দোখান",
            "আল জাসিয়াহ",
            "আল আহ্‌ক্বাফ",
            "মুহাম্মদ",
            "আল ফাত্‌হ",
            "আল হুজুরাত",
            "ক্বাফ",
            "আয-যারিয়াত",
            "আত্ব তূর",
            "আন-নাজম",
            "আল ক্বামার",
            "আর রাহমান",
            "আল-ওয়াকিয়াহ",
            "আল-হাদীদ",
            "আল-মুজাদালাহ",
            "আল-হাশর",
            "আল-মুমতাহিনাহ",
            "আস-সাফ",
            "আল-জুমুআ",
            "আল-মুনাফিকুন",
            "আত-তাগাবুন",
            "আত-তালাক",
            "আত-তাহরীম",
            "আল-মুলক",
            "আল-কলম",
            "আল-হাক্কাহ",
            "আল-মাআরিজ",
            "নূহ",
            "আল জ্বিন",
            "আল মুজাম্মিল",
            "আল মুদ্দাস্সির",
            "আল-ক্বিয়ামাহ",
            "আদ-দাহর",
            "আল-মুরসালাত",
            "আন নাবা",
            "আন নাযিয়াত",
            "আবাসা",
            "আত-তাকভীর",
            "আল-ইনফিতার",
            "আত মুত্বাফ্‌ফিফীন",
            "আল ইন‌শিকাক",
            "আল-বুরুজ",
            "আত-তারিক্ব",
            "আল আ'লা",
            "আল গাশিয়াহ্‌",
            "আল ফাজ্‌র",
            "আল বালাদ",
            "আশ-শাম্‌স",
            "আল-লাইল",
            "আদ-দুহা",
            "আল ইনশিরাহ",
            "আত-ত্বীন",
            "আলাক্ব",
            "ক্বদর",
            "বাইয়্যিনাহ",
            "যিলযাল",
            "আল-আদিয়াত",
            "আল-ক্বারিয়াহ",
            "আত-তাকাসুর",
            "আল-আছর",
            "হুমাযাহ",
            "আল-ফীল",
            "কুরাইশ",
            "মাউন",
            "আল-কাওসার",
            "আল-কাফিরুন",
            "আন-নাসর",
            "লাহাব",
            "আল-ইখলাস",
            "আল-ফালাক",
            "আন-নাস",
        ];

        foreach($collection as $index => $item) {

            // dd($item);

            $data[] = [
                "id"                    => $item->id,
                "sura_number"           => $item->id,
                "total_ayah"            => $item->verses_count,
                "bismillah_pre"         => $item->bismillah_pre ? 1 : 0,
                "revelation_place"      => $revelation_place[$item->revelation_place],
                "revelation_order"      => $item->revelation_order,
                "arabic"                => $item->name_arabic,
                "bengali_meaning"       => $collection_bn[$index]->translated_name->name,
                "bengali_pronunciation" => $bengali_pronunciations[$index],
                "english_meaning"       => $item->translated_name->name,
                "english_pronunciation" => $item->name_simple,
            ];
        }

        // dd($data);

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
                "id"            => $item->id,
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

        // dd($data);

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

    public function apiToTranslationsStore()
    {
        $response = Http::get('https://api.quran.com/api/v4/resources/translations');
        
        $collection = $response->object()->translations;

        // dd($collection);

        $collection = array_filter($collection, function ($item) {
            // return $item->language_name == 'bengali';
            return $item->language_name == 'english';
        });

        // dd($collection);

        foreach($collection as $item) {
            if(Resource::where('name', $item->name)->exists()) {
                continue;
            }

            $resource = Resource::create([
                'name' => $item->name,
                'author' => $item->author_name,
                'language_id' => 2, // 1=bengali, 2=english
            ]);

            $response2 = Http::get('https://api.quran.com/api/v4/quran/translations/' . $item->id);
        
            $collection2 = $response2->object()->translations;

            $data = [];

            foreach($collection2 as $index => $row) {
                $data[] = [
                    'resource_id' => $resource->id,
                    'ayah_number' => $index + 1,
                    'text' => $row->text,
                ];
            }

            Translation::insert($data);
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
