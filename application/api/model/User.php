<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25 0025
 * Time: 9:22
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getUserByOpendid($openid)
    {
        $user = self::where('openid', '=', $openid)->find();
        return $user;
    }
}