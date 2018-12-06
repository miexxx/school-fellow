<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:35
 */

namespace App\Api\Controllers;


use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\UserSchool;

class SchoolAttController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function attestation(){
        //验证
        $data = [
            'name'=>request('name'),
            'entrance_time'=>request('entrance_time'),
            'major'=>request('major'),
            'school_name'=>request('school_name'),
            'user_id'=>$this->user->id??null
        ];
        if($this->user->userSchool)
            return ResultTool::apiMessage(ResultTool::ERROR,'该用户已经提交过申请');
        foreach ($data as $value){
            if(!$value){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        //逻辑
        UserSchool::create($data);
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }
}