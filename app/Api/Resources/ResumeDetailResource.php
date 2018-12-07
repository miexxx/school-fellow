<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeDetailResource extends JsonResource
{

    public function toArray($request)
    {
        return [
           'baseInfo'=>new ResumeBaseResource($this),
            'wish'=> new ResumeWishResource($this),
            'work'=>ResumeWorkResource::collection($this->works),
            'mobile'=>auth('api')->user()->mobile
        ];
    }
}