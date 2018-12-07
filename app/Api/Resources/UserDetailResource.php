<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=>$this->userSchool->name??$this->nickname,
            'avatarurl'=>$this->avatarurl,
            'company'=>$this->userCompany->name??null,
            'position' =>$this->userCompany->position??null,
            'mobile'=>$this->mobile,
            'wechat'=>$this->wechat,
            'city'=>$this->city,
            //todo
            'school_info'=>$this->userSchool?[
                'school_name'=>$this->userSchool->school_name,
                'major'=>$this->userSchool->major,
                'entrance_time' =>$this->userSchool->entrance_time
            ]:null
        ];
    }
}