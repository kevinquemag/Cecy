<?php

namespace App\Http\Resources\V1\Core;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InstitutionCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
