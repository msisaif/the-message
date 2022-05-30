<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'amount'    => (double) ($this->amount ?? 0),
            'image'     => (string) ($this->image ?? ''),
            'video'     => (string) ($this->video ?? ''),
            'details'   => (string) ($this->details ?? ''),
            'topics'    => TopicResource::collection($this->whenLoaded('topics')),
            'mentors'   => MentorResource::collection($this->whenLoaded('mentors')),
        ];
    }
}
