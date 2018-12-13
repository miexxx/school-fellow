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
class Feedbacks extends Model
{
    use Search;
    protected $guarded=[];
    const ISSEE = 2;
    const NOTSEE = 1;
    protected $status =[
        self::NOTSEE => '未查看',
        self::ISSEE =>'已查看'
    ];

    public function getStatusAttribute($key)
    {
        return $this->status[$key];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}