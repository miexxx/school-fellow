<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5/005
 * Time: 14:12
 */

namespace App\Api\Tool;


class ResultTool
{
    const SUCCESS = 100;
    const ERROR = 0;

    const PAGINATE = 10;
    static $messageType =[
        self::SUCCESS => '请求成功',
        self::ERROR=> '请求失败'
    ];
    static function apiResourcesMessage($code,$data=null,$message=null){
        return response()->json([
            'code'=>$code,
            'message'=>$message??self::$messageType[$code],
            'data'=>$data
        ]);
    }
    static function apiArrayMessage($code,$data=null,$message=null){
        return response()->json([
            'code'=>$code,
            'message'=>$message??self::$messageType[$code],
            'data'=>$data
        ]);
    }
    static function apiMessage($code,$message=null){
        return response()->json([
            'code'=>$code,
            'message'=>$message??self::$messageType[$code],
        ]);
    }
    static function swlMessage($code ,$message=null){
        return response()->json(['status' => $code, 'message' =>$message]);
    }

}