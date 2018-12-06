<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4/004
 * Time: 16:20
 */
namespace App\Admin\Controllers\User;

use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\User;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 会员管理
 *
 * Class HomeController
 * @package App\Admin\Controllers
 */
class UserController extends Controller
{
    /**
     * @permission 会员列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->like('nickname');
            $searcher->equal('mobile');
            $searcher->like('wechat');
            $searcher->between('created_at');
        });
        $users =(new User)->search($searcher)->orderBy('created_at','desc')->paginate(ResultTool::PAGINATE);
        $header = "会员列表";
        return view('admin::users.users',compact('users','header'));
    }


    public function destroy($id){
        $user = User::find($id);
        $user->openId->delete();
        $user->delete();
        return ResultTool::swlMessage(1,'删除成功');
    }

}