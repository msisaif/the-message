<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'course_id' => (int) ($this->course_id ?? 0),
            'contents'  => ContentResource::collection($this->whenLoaded('contents')),
        ];
    }
}
