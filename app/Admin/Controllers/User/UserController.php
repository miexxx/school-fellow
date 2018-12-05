<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4/004
 * Time: 16:20
 */
namespace App\Admin\Controllers\User;

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
        $users =(new User)->search($searcher)->orderBy('created_at','desc')->paginate(User::PAGINATE);
        $header = "会员列表";
        return view('admin::users.users',compact('users','header'));
    }


    public function destroy($id){
        User::find($id)->delete();
        return response()->json(['status' => 1, 'message' =>'删除成功']);
    }

}