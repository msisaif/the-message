<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
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
            'topic_id'  => (int) ($this->topic_id ?? 0),
            'type'      => (int) ($this->type ?? ''),
            'title'     => (string) ($this->title ?? ''),
            'link'      => (string) ($this->link ?? ''),
            // 'questions' => (array) ($this->questions ?? []),
        ];
    }
}
