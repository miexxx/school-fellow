<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionDetailResource extends JsonResource
{

    public function toArray($request)
    {
        $this->load('covers');
        return [
            'id' => $this->id,
            'title'=>$this->title,
            'city'=>$this->type == 1?$this->province:$this->city,
            'pay'=>$this->pay,
            'begin_time'=>$this->begin_time,
            'over_time' =>$this->over_time,
            'adr_detail' =>$this->adr_detail,
            'host' => new ActionUserResource($this->user),
            'people' =>ActionUserResource::collection($this->users),
            'count' =>$this->users->count(),
            'content'=>$this->content,
            'covers'=>CoverResource::collection($this->covers)
        ];
    }
}