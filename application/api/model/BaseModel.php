<?php

namespace app\api\model;

use think\facade\Config;
use think\Model;

class BaseModel extends Model
{
    protected function prefixImgUrl($val, $data)
    {
        $res = $val;
        if ($data['from'] == 1) {
            $res = Config::get('app.img_prefix') . $val;
        }
        return $res;
    }
}
