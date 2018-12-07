<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:35
 */

namespace App\Api\Controllers;


use App\Api\Resources\UserDetailResource;
use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\UserCompany;
use App\Models\UserSchool;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function store(){
        //验证
        $userData = [
            'nickname'=>request('nickname'),
            'gender'=>request('gender'),
            'city'=>request('address'),
        ];
        $companyData = [
            'name'=>request('name'),
            'position'=>request('position'),
        ];
        foreach ($userData as $value){
            if(!$value){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        //逻辑
        $userData['wechat']=request('wechat');
        $this->user->update($userData);
        if($this->user->userCompany)
            $this->user->userCompany->update($companyData);
        else {
            $companyData['user_id']= $this->user->id;
            UserCompany::create($companyData);
        }
        if(request('avatar')){
            $path = request('avatar')->store('avatar','public');
            $this->user->avatarurl = Storage::disk('public')->url($path);
            $this->user->save();
        }
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    public function index(){
        if(!$this->user){
            return ResultTool::apiMessage(ResultTool::ERROR);
        }
        $data =(new UserDetailResource($this->user));
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,$data);
    }
}