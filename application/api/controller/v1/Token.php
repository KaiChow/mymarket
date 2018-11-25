<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25 0025
 * Time: 9:18
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token extends BaseController
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return json([
            'token' => $token
        ]);

    }

}