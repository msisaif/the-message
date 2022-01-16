<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => (int) $this->id,
            'suraNumber'            => (int) ($this->sura_number ?? 0),
            'totalAyah'             => (int) ($this->total_ayah ?? 0),
            'bismillahPre'          => (boolean) ($this->bismillah_pre ?? false),
            'revelationPlace'       => (int) ($this->revelation_place ?? 0),
            'revelationOrder'       => (int) ($this->revelation_order ?? 0),
            'arabic'                => (string) ($this->arabic ?? ''),
            'bengaliMeaning'        => (string) ($this->bengali_meaning ?? ''),
            'bengaliPronunciation'  => (string) ($this->bengali_pronunciation ?? ''),
            'englishMeaning'        => (string) ($this->english_meaning ?? ''),
            'englishPronunciation'  => (string) ($this->english_pronunciation ?? ''),
        ];
    }
}
