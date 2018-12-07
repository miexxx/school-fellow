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
class UserResume extends Model
{
    use Search;
    protected $guarded=[];
    private $sex=[
        '1'=>'男',
        '2'=>'女'
    ];

    public function getGenderAttribute($value)
    {
        return $this->sex[$value];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function skills(){
        return $this->hasMany(ResumeSkill::class);
    }

    public function certs(){
        return $this->hasMany(ResumeCert::class);
    }

    public function works(){
        return $this->hasMany(ResumeWork::class);
    }
}