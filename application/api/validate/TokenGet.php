<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25 0025
 * Time: 9:19
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

}