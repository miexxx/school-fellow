<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:35
 */

namespace App\Api\Controllers;


use App\Api\Resources\ActionDetailResource;
use App\Api\Resources\UserDetailResource;
use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\UserCompany;
use App\Models\UserSchool;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function index(){
        $type= request('type');
        $actions = Actions::where('status',Actions::SUCCESS)->where('type',$type)->orderBy('type',$type)->paginate(ResultTool::PAGINATE);
        return api()->collection($actions,ActionResource::class);
    }

    public function show(Actions $action){
        return ResultTool::apiResourcesMessage(ResultTool::SUCCESS,new ActionDetailResource($action));
    }

    public function store(){
        //校验
        $data = [
            'title' =>request('title'),
            'type' =>request('type'),
            'pay' =>request('pay'),
            'province' =>request('province'),
            'city' =>request('city'),
             'adr_detail' =>request('adr_detail'),
            'content' =>request('content'),
            'begin_time' =>request('begin_time'),
            'over_time' =>request('over_time'),
            'user_id' =>$this->user->id
        ];
        foreach ($data as $value){
            if(!$value || !request('path')){
                return ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        //逻辑
        $action = Actions::create($data);
        foreach (request('path') as $file) {
            $path = $file->store('banner', 'public');
            $action->covers()->create(['path'=>$path]);
        }
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    public function join(Actions $action){
        if($action->status === '未审核' )
            return  ResultTool::apiMessage(ResultTool::ERROR);
        foreach($action->users as $user){
            if($this->user->id == $user->id){
                return  ResultTool::apiMessage(ResultTool::ERROR);
            }
        }
        $action->users()->attach($this->user->id);
        return  ResultTool::apiMessage(ResultTool::SUCCESS);
    }
}