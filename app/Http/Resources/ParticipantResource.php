<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
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
            'id'            => (int) ($this->id ?? 0),
            'userId'        => (int) ($this->user_id ?? 0),
            'courseId'      => (int) ($this->course_id ?? 0),
            'course'        => new CourseResource($this->whenLoaded('course')),
            'amount'        => (double) ($this->amount ?? 0),
            'due'           => (double) ($this->due ?? 0),
            'certificate'   => (boolean) ($this->certificate ?? false),
            'active'        => (boolean) ($this->certificate ?? false),
            'comment'       => (string) ($this->comment ?? ''),
        ];
    }
}
