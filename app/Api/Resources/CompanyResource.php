<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'position'=>$this->position,
            'wechat'=>$this->user->wechat
        ];
    }
}