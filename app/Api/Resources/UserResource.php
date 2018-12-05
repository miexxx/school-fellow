<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nickname'=>$this->nickname,
            'gender'=>$this->gender,
            'city'=>$this->city,
            'wechat'=>$this->wechat,
            'avatarurl' =>$this->avatarurl,
            'mobile' =>$this->mobile
        ];
    }
}