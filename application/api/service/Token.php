<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/23
 * Time: 15:46
 */

namespace app\api\service;

class Token
{
    public static function generateToken(){
        // 32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        //用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('app.token_salt');
        return md5($randChars.$timestamp.$salt);
    }


}