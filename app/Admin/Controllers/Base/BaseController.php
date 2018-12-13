<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:52
 */

namespace App\Admin\Controllers\Base;


use App\Api\Tool\ResultTool;
use App\Http\Controllers\Controller;
use App\Models\Abouts;
use App\Models\Feedbacks;
use Tanmo\Search\Facades\Search;
use Tanmo\Search\Query\Searcher;
/**
 * @module 基础管理
 *
 * Class HomeController
 * @package App\Admin\Controllers
 */
class BaseController extends Controller
{
    /**
     * @permission 意见反馈列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedbackIndex(){
        $searcher = Search::build(function (Searcher $searcher) {
            $searcher->equal('status');
            $searcher->like('user.nickname','nickname');
            $searcher->like('user.mobile','mobile');
            $searcher->between('created_at');
        });
        $header = "意见反馈列表";
        $feedbacks = (new Feedbacks())->search($searcher)->orderBy('status','asc')->orderBy('created_at','desc')->paginate(ResultTool::PAGINATE);
        return view('admin::base.feedbacks',compact('feedbacks','header'));
    }

    public function feedbackDestory(Feedbacks $feedback){
        $feedback->delete();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'删除成功！');
    }

    public function feedbackContent(Feedbacks $feedback){
        $feedback->status = Feedbacks::ISSEE;
        $feedback->save();
        return ResultTool::swlMessage(ResultTool::SUCCESS,'查看成功！');
    }



    /**
     * @permission 关于我们/技术支持
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){
        $about = Abouts::where('id',Abouts::ABOUTME)->first();
        $skill = Abouts::where('id',Abouts::SKILL)->first();
        return view('admin::base.abouts',compact('about','skill'));
    }
    public function aboutStore(){
        $aboutContent = request('aboutContent');
        $skillContent = request('skillContent');
        $about = Abouts::where('id',Abouts::ABOUTME)->first();
        $about->content = $aboutContent;
        $about->save();
        $skill = Abouts::where('id',Abouts::SKILL)->first();
        $skill->content = $skillContent;
        $skill->save();
        return redirect()->route('admin::about.index');
    }
}