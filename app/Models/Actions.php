<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:22
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;
use Tanmo\Search\Traits\Search;
class Actions extends Model
{
    use Search;
    protected $guarded=[];
    protected $status=[
        '1'=>'未审核',
        '2'=>'审核通过'
    ];
    protected $type =[
        '1' =>'省级',
        '2' =>'市级'
    ];
    const SUCCESS = 2;
    const WAIT = 1;
    public function covers(){
        return $this->hasMany(ActionCovers::class,'action_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($key)
    {
        return $this->status[$key];
    }

    public function getTypeAttribute($key){
        return $this->type[$key];
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_join_actions','action_id','user_id');
    }
}