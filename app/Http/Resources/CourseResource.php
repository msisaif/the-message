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
            'id'            => (int) ($this->id),
            'title'         => (string) ($this->title ?? ''),
            'amount'        => (double) ($this->amount ?? 0),
            'video'         => (string) ($this->video ?? ''),
            'description'   => (string) ($this->description ?? ''),
            'image'         => new ImageResource($this->whenLoaded('image')),
            'imageUrl'      => (string) ($this->image->url ?? ''),
            'topics'        => TopicResource::collection($this->whenLoaded('topics')),
            'mentors'       => MentorResource::collection($this->whenLoaded('mentors')),
        ];
    }
}
