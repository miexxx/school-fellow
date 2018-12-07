<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:35
 */

namespace App\Api\Controllers;


use App\Api\Resources\ResumeBaseResource;
use App\Api\Resources\ResumeDetailResource;
use App\Api\Resources\ResumeWishResource;
use App\Api\Resources\ResumeWorkResource;
use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\UserCompany;
use App\Models\UserResume;
use App\Models\UserSchool;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }
    public function showBaseInfo(){
        if(!$this->user->userResume){
            $date = null;
            return ResultTool::apiArrayMessage(ResultTool::SUCCESS,'数据为空');
        }
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,new ResumeBaseResource($this->user->userResume));
    }
    public function baseInfo(){
        //验证
        $baseInfo = [
            'name'=>request('name'),
            'age'=>request('age'),
            'status'=>request('status'),
            'gender'=>request('gender'),
            'household'=>request('household'),
            'address'=>request('address'),
            'address_detail' =>request('address_detail'),
            'major' => request('major'),
            'evaluation'=>request('evaluation'),
            'user_id'=>$this->user->id,
        ];

        foreach ($baseInfo as $value){
            if(!$value){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }

        //逻辑
        if(request('avatar')){
            $path = request('avatar')->store('avatar','public');
            $path = Storage::disk('public')->url($path);
            $baseInfo['avatar']=$path;
        }
        if($this->user->userResume) {
            $skills = json_decode(request('skills'),1);
            $certs = json_decode(request('certs'),1);
            if(json_last_error()|| count($skills)>6 ||  count($certs)>6){
                return ResultTool::apiMessage(ResultTool::ERROR,'数据错误');
            }
            $this->user->userResume->skills()->delete();
            $this->user->userResume->certs()->delete();
            foreach ($skills as $skill){
                $this->user->userResume->skills()->create(['content'=>$skill]);
            }
            foreach ($certs as $cert){
                $this->user->userResume->certs()->create(['content'=>$cert]);
            }
            $this->user->userResume->update($baseInfo);
        }
        else {
            UserResume::create($baseInfo);
        }
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    public function wishInfo(){
        if(!$this->user->userResume){
            return ResultTool::apiMessage(ResultTool::ERROR);
        }
        $wish_data =[
            'wish_position'=>request('wish_position'),
            'wish_salary'=>request('wish_salary'),
            'wish_address'=>request('wish_address'),
        ];
        foreach ($wish_data as $value){
            if(!$value){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        $this->user->userResume->update($wish_data);
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    public function showWishInfo(){
        if(!$this->user->userResume){
            $date = null;
            return ResultTool::apiArrayMessage(ResultTool::SUCCESS,'数据为空');
        }
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,new ResumeWishResource($this->user->userResume));
    }

    public function workInfo(){
        if(!$this->user->userResume){
            return ResultTool::apiMessage(ResultTool::ERROR);
        }

        $names=json_decode(request('name'),1);
        $positions=json_decode(request('position'),1);
        $begin_times=json_decode(request('begin_time'),1);
        $leave_reasons=json_decode(request('leave_reason'),1);
        if(json_last_error() ||!$this->check($names,$positions,$begin_times,$leave_reasons)){
            return ResultTool::apiMessage(ResultTool::ERROR);
        }
        $this->user->userResume->works()->delete();
        foreach ($names as $key => $value){
            $data =[
                'name'=>$names[$key],
                'position'=>$positions[$key],
                'begin_time'=>$begin_times[$key],
                'leave_reason'=>$leave_reasons[$key],
            ];
            $this->user->userResume->works()->create($data);
        }
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }
    public function showWorkInfo(){
        if(!$this->user->userResume){
            $date = null;
            return ResultTool::apiArrayMessage(ResultTool::SUCCESS,'数据为空');
        }
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,ResumeWorkResource::collection($this->user->userResume->works));
    }

    public function index(){
        if(!$this->user->userResume){
            $date = null;
            return ResultTool::apiArrayMessage(ResultTool::SUCCESS,'数据为空');
        }
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,new ResumeDetailResource($this->user->userResume));

    }













    //校验函数
    public function check($names,$positions,$begin_times,$leave_reasons){
        $count =count($names);
        if($count ==0 ||count($names)!=$count ||count($positions)!=$count ||count($begin_times)!=$count ||count($leave_reasons) !=$count){
            return false;
        }
        return true;
    }
}