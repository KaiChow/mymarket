<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25 0025
 * Time: 9:25
 */

namespace app\api\service;

use app\api\exception\TokenException;
use app\api\exception\WeChatException;
use app\api\model\User as UserModel;
use think\Exception;

/**
 * Class UserToken
 * @package app\api\controller\service
 * 在model层之上
 */
class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('app.app_id');
        $this->wxAppSecret = config('app.app_secret');
        $this->wxLoginUrl = sprintf(config('app.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }


    public function get()
    {
        $result = curl_get($this->wxLoginUrl);


        $jsResult = json_decode($result);

        $wxResult = [];

        foreach ($jsResult as $key => $value) {
            $wxResult[$key] = $value;
        }

        if (empty($wxResult)) {
            throw new Exception('获取sessionkey和openid失败，微信内部错误！');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError();
            } else {
                return $this->grantToken($wxResult);
            }
        }


    }

    protected function grantToken($wxResult)
    {
        /**
         * 1,获取openid
         * 2，查询数据库openid是否存在
         * 3，存在不处理，不存在user新增数据
         * 4，生成令牌，准备缓存数据，写入缓存  value:wxResult uid  scope
         * 5，把令牌返回到客户端
         */

        $openid = $wxResult['openid'];

        $user = UserModel::getUserByOpendid($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openid);
        }


        $cacheValue = $this->cacheValePrepare($wxResult, $uid);

        $token = $this->saveToCache($cacheValue);

        return $token;
    }

    protected function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('app.token_expire_in');

        $request = cache($key, $value, $expire_in);//默认文件形式
        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => '10004'
            ]);
        }

        return $key;
    }

    public function cacheValePrepare($wxResult, $uid)
    {
        $value = $wxResult;
        $value['uid'] = $uid;
        //  16  ==app用户权限  32==CMS（管理员权限）
        $value['scope'] = \ScopeEnum::User;
        return $value;
    }

    public function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);

        return $user->id;
    }

    protected function processLoginError()
    {
        throw new WeChatException();
    }

}