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
use App\Models\UserCompany;
use App\Models\UserSchool;

class CompanyController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function store(){
        //验证
        $data = [
            'name'=>request('name'),
            'position'=>request('position'),
            'address'=>request('address'),
        ];
        foreach ($data as $value){
            if(!$value || !request('wechat')){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        //逻辑
        $this->user->update(['wechat'=>request('wechat')]);
        if($this->user->userCompany)
            $this->user->userCompany->update($data);
        else {
            $data['user_id']= $this->user->id;
            UserCompany::create($data);
        }
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }
}