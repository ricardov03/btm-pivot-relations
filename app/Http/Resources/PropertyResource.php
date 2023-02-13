<?php

namespace App\Http\Resources;

use App\Models\ProductProperty;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(is_null($this->parent)) {
            return [
                'property_id' => $this->id,
                'property_name' => $this->name,
                'sub_properties' => new PropertyCollection($this->properties),
            ];
        }

        return [
            'property_id' => $this->id,
            'property_name' => $this->name,
        ];
    }
}
