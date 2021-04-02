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
            'titulo' => $this->title,
            'flag' => $this->flag,
            'uuid' => $this->uuid,
            'image' => url("storage/{$this->image}"),
            'description' => $this->description,
            'price' => $this->price,
        ];
    }
}
