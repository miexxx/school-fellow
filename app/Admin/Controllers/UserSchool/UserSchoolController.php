<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:52
 */

namespace App\Admin\Controllers\UserSchool;


use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\UserSchool;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 校友认证管理
 *
 * Class HomeController
 * @package App\Admin\Controllers
 */
class UserSchoolController extends Controller
{
    /**
     * @permission 校友认证申请列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->equal('status');
            $searcher->like('name');
            $searcher->like('user.nickname','nickname');
            $searcher->like('user.mobile','mobile');
            $searcher->between('created_at');
        });
        $header = "校友认证申请列表";
        $userSchools = (new UserSchool())->search($searcher)->orderBy('status','asc')->orderBy('created_at','desc')->paginate(ResultTool::PAGINATE);
        return view('admin::userSchool.usersSchool',compact('userSchools','header'));
    }

    public function success(UserSchool $userSchool){
        $userSchool->status =  UserSchool::SUCCESS;
        $userSchool->save();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'操作成功');
    }

    public function reject(UserSchool $userSchool){
        $userSchool->delete();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'操作成功');
    }
}