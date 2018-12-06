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
class UserCompany extends Model
{
    use Search;
    protected $guarded=[];
    protected $table='user_companys';
    public function user(){
        return $this->belongsTo(User::class);
    }
}