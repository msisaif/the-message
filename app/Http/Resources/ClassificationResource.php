<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationResource extends JsonResource
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
            'suraName'      => (string) ($this->sura->bengali_pronunciation ?? ''),
            'sura'          => new SuraResource($this->whenLoaded('sura')),
            'topic'         => (string) ($this->topic ?? ''),
            'ayah'          => (string) ($this->ayah ?? ''),
            'ayahs'         => (array) ($this->ayahs ?? []),
        ];
    }
}
