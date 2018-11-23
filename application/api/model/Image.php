<?php

namespace app\api\model;

use think\Model;

class Image extends Model
{
    protected $hidden = ['delete_time', 'update_time', 'id'];

    public function getUrlAttr($val)
    {
        return 'http://www.api.com' . $val;
    }
}
