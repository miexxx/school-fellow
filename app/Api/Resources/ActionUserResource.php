<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionUserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'avatarurl' =>$this->avatarurl,
            'realname'=>$this->userSchool->name,
            'major'=>$this->userSchool->major,
            'grade'=>date('y',time($this->userSchool->entrance_time)).'级'
        ];
    }
}