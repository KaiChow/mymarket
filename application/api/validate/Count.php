<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/24 0024
 * Time: 10:55
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}