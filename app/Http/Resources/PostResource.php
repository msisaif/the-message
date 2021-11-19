<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id'            => $this->id,
            'slug'          => $this->slug,
            'title'         => $this->title,
            'description'   => $this->description,
            'thumbnail'     => $this->thumbnail,
            'body'          => $this->body,
            'userId'        => $this->user_id,
            'userName'      => $this->user->name,
            'type'          => $this->type,
            'valueOfType'   => $this->value_of_type,
        ];
    }
}
