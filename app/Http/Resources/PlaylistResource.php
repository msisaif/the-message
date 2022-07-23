<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
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
            'id'        => (int) ($this->id),
            'title'     => (string) ($this->title ?? ''),
            'type'      => (string) ($this->type ?? ''),
            'typeText'  => (string) ($this->type_text ?? ''),
            'image'     => new ImageResource($this->whenLoaded('image')),
            'imageUrl'  => (string) ($this->image->url ?? ''),
        ];
    }
}
