<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
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
            'name'          => (string) ($this->name ?? ''),
            'phone'         => (string) ($this->phone ?? ''),
            'address'       => (string) ($this->address ?? ''),
            'designation'   => (string) ($this->designation ?? ''),
            'image'         => new ImageResource($this->whenLoaded('image')),
            'imageUrl'      => (string) ($this->image->url ?? ''),
            'firstLatter'   => (string) (mb_strtoupper(mb_substr($this->name, 0, 1, 'utf-8'), 'utf-8') ?? ''),
        ];
    }
}
