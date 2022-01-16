<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyahResource extends JsonResource
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
            'id'            => (int) $this->id,
            'suraNumber'    => (int) ($this->sura_number ?? 0),
            'ayahNumber'    => (int) ($this->ayah_number ?? 0),
            'juzNumber'     => (int) ($this->juz_number ?? 0),
            'pageNumber'    => (int) ($this->page_number ?? 0),
            'position'      => (int) ($this->position ?? 0),
            'sajdah'        => (boolean) ($this->sajdah ?? false),
            'key'           => (string) ($this->key ?? ""),
            'text'          => (string) ($this->text ?? ""),
        ];
    }
}
