<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:22
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Tanmo\Search\Traits\Search;
class UserSchool extends Model
{
    use Search;
    protected $guarded=[];
    protected $status=[
        '0'=>'未审核',
        '1'=>'审核通过'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value)
    {
        return $this->status[$value];
    }
}