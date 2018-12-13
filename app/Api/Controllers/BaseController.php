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
use App\Models\Abouts;
use App\Models\Feedbacks;
use App\Models\UserSchool;

class BaseController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function feedbackStore(){
        $content = request('content');
        if(!$content){
            return ResultTool::apiMessage(ResultTool::ERROR);
        }
        Feedbacks::create(['user_id'=>$this->user->id,'content'=>$content]);
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    public function about(){
        $about = Abouts::where('id',Abouts::ABOUTME)->first();
        $data = [
            'content'=>$about->content
        ];
        return ResultTool::apiArrayMessage(ResultTool::SUCCESS,$data);
    }

    public function skill(){
        $skill = Abouts::where('id',Abouts::SKILL)->first();
        $data = [
            'content'=>$skill->content
        ];
        return ResultTool::apiArrayMessage(ResultTool::SUCCESS,$data);
    }
}