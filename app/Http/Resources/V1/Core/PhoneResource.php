<?php

namespace App\Http\Resources\V1\Core;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'operator' => CatalogueResource::make($this->operator),
            'location' => LocationResource::make($this->location),
            'type' => LocationResource::make($this->type),
        ];
    }
}
