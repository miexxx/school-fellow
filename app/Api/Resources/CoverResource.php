<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoverResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'path'=>$this->path,
        ];
    }
}