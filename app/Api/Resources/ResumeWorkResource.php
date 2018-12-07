<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeWorkResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'position'=>$this->position,
            'begin_time'=>$this->begin_time,
            'leave_reason'=>$this->leave_reason
        ];
    }
}