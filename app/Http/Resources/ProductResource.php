<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'identify' => $this->uuid,
            'flag' => $this->flag,
            'image' => $this->image ? url('storage/'.$this->image) : Null,
            'price' => $this->price,
            'desription' => $this->description
        ];
    }
}