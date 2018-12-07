<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeWishResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'wish_salary'=>$this->wish_salary,
            'wish_position'=>$this->wish_position,
            'wish_address'=>$this->wish_address
        ];
    }
}