<?php

namespace App\Imports;

use App\Models\Ayah;
use App\Models\Juz;
use App\Models\Sura;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CollectionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $data = [];

        $juzs = Juz::pluck('id', 'first_ayah');

        // dd($juzs);

        $juz = 0;

        foreach($collection as $item) {
            $data[] = [
                "sura_number" => explode(":", $item['verse_key'])[0],
                "position" => explode(":", $item['verse_key'])[1],
                "key" => $item['verse_key'],
                "text" => $item['text_indopak'],
                "ayah_number" => $item['id'],
                "juz_number" => isset($juzs[$item['id']]) ? $juz = $juzs[$item['id']] : $juz
            ];
        }

        dd($data);

        return Ayah::insert($data);
    }
}
