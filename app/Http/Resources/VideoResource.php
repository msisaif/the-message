<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            "id"        => (int) $this->id,
            "type"      => (int) ($this->type ?? 1),
            "typeText"  => (string) ($this->type_text ?? ""),
            "title"     => (string) ($this->title ?? ''),
            "url"       => (string) ($this->url ?? ''),
            'image'     => new ImageResource($this->whenLoaded('image')),
            'imageUrl'  => (string) ($this->image->url ?? ''),
        ];
    }
}
