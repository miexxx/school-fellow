<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 15:22
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Tanmo\Search\Traits\Search;
class Abouts extends Model
{
    use Search;
    protected $guarded=[];
    const ABOUTME = 1;
    const SKILL = 2;
    protected $status =[
        self::ABOUTME => '关于我们',
        self::SKILL =>'技术支持'
    ];
}