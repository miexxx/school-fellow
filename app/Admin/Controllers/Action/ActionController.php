<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:52
 */

namespace App\Admin\Controllers\Action;


use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\UserSchool;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 活动创建管理
 *
 * Class HomeController
 * @package App\Admin\Controllers
 */
class ActionController extends Controller
{
    /**
     * @permission 活动申请列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->equal('status');
            $searcher->like('title');
            $searcher->like('user.nickname','nickname');
            $searcher->like('user.mobile','mobile');
            $searcher->between('created_at');
        });
        $header = "活动申请列表";
        $actions = (new Actions())->search($searcher)->orderBy('status','asc')->orderBy('created_at','desc')->paginate(ResultTool::PAGINATE);
        return view('admin::actions.actions',compact('actions','header'));
    }

    public function success(Actions $action){
        $action->status =  Actions::SUCCESS;
        $action->save();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'操作成功');
    }

    public function reject(Actions $action){
        $action->delete();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'操作成功');
    }
}