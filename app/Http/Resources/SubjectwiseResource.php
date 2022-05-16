<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectwiseResource extends JsonResource
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
            'categoryId'    => (int) ($this->category_id ?? 0),
            'categoryName'  => (string) ($this->category->name ?? ''),
            'title'         => (string) ($this->title ?? ''),
            'type'          => (int) ($this->type ?? 0),
            'typeText'      => (string) ($this->type_text ?? ''),
            'arabic'        => (string) ($this->arabic ?? ''),
            'bengali'       => (string) ($this->bengali ?? ''),
        ];
    }
}
