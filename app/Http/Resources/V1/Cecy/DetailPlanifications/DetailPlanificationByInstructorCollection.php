<?php

namespace App\Http\Resources\V1\Cecy\DetailPlanifications;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DetailPlanificationByInstructorCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
