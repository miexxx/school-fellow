<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeBaseResource extends JsonResource
{

    public function toArray($request)
    {
        $skills =[];
        $certs =[];
        foreach ($this->skills as $value){
            $skills[]=$value->content;
        }
        foreach ($this->certs as $value){
            $certs[]=$value->content;
        }
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'avatar'=>$this->avatar,
            'gender'=>$this->gender,
            'age'=>$this->age,
            'status'=>$this->status,
            'household'=>$this->household,
            'address'=>$this->address,
            'address_detail'=>$this->address_detail,
            'major'=>$this->major,
            'evaluation'=>$this->evaluation,
            'skills'=>$skills,
            'certs'=>$certs,
        ];
    }
}