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
class ResumeSkill extends Model
{
    use Search;
    protected $guarded=[];

    public function resume(){
        return $this->belongsTo(UserResume::class);
    }

}