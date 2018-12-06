<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5/005
 * Time: 15:24
 */
namespace App\Api\Controllers;
use App\Api\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthWechat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use EasyWeChat\Factory;
use App\Api\Tool\ResultTool;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except' => ['login','refresh','logout']]);
    }
    public function login(){
        $config = [
//            'app_id' => 'wx43c66e8ce3d9b082',
//            'secret' => '3b20951f94d556626a1342f3a8e79e63',
//
            'app_id' => 'wx9bec3d0bf6ecc0d7',
            'secret' => '29502aca9d39ff4f6ca15376447b55ed',

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
            
        ];
        $code = request('code');
        $iv = request('iv');
        $encryptData = request('encrypted_data');
        $app = Factory::miniProgram($config);
        $session = $app->auth->session($code);
        $userInfo = $app->encryptor->decryptData($session['session_key'], $iv, $encryptData);
        $auth =(new UserAuthWechat())->getByOpenId($userInfo['openId']);
        if(!$auth){
            /// 未注册
            DB::beginTransaction();
            $user = new User();
            $user->avatarUrl = $userInfo['avatarUrl'];
            $user->nickname = $userInfo['nickName'];
            $user->gender = $userInfo['gender'];
            $user->city = $userInfo['country'].$userInfo['province'].$userInfo['city'];
            $user->save();

            $authWechat = new UserAuthWechat(['open_id' => $userInfo['openId'],'session_key'=>$session['session_key']]);
            $user->openId()->save($authWechat);
            DB::commit();
        }
        else{
            $user = $auth->user;
            User::where('id', $user->id)
                ->update(['avatarUrl' => $userInfo['avatarUrl']]);
            $user->openId->update(['session_key'=>$session['session_key']]);
        }
        $token = auth('api')->login($user);
        return api()->item($user, UserResource::class)->setMeta($this->respondWithToken($token));
    }

    /**
     * @return Json
     */
    public function refresh()
    {
        return ResultTool::apiArrayMessage(ResultTool::SUCCESS,$this->respondWithToken(auth('api')->refresh()));
    }

    /**
     * @return null
     */
    public function logout()
    {
        auth()->logout();
        return ResultTool::apiMessage(ResultTool::SUCCESS);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}