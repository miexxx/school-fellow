<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Tanmo\Admin\Controllers\Main;

/**
 * @module 管理后台
 *
 * Class HomeController
 * @package App\Admin\Controllers
 */
class HomeController extends Controller
{
    /**
     * @permission 主页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return Main::envs();
    }
}