<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
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
            'resourceId'    => (int) ($this->resource_id ?? 0),
            'ayahNumber'    => (int) ($this->ayah_number ?? 0),
            'text'          => (string) ($this->text ?? ''),
        ];
    }
}
