<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JuzResource extends JsonResource
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
            'id'                => (int) $this->id,
            'juzNumber'         => (int) ($this->juz_number ?? 0),
            'name'              => (string) ($this->name ?? ""),
            'firstAyah'         => (int) ($this->first_ayah ?? 0),
            'lastAyah'          => (int) ($this->last_ayah ?? 0),
            'totalAyah'         => (int) ($this->total_ayah ?? 0),
            'suras'             => SuraResource::collection($this->suras),
        ];
    }
}
