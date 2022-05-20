<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Categories extends JsonResource
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
            'id' => $this->id,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug,
            'category_image' => URL('category_image/'.$this->category_image),
            'status' => $this->status
        ];
    }
}
