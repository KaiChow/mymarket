<?php

namespace app\api\model;

class Image extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time', 'id'];

    public function getUrlAttr($val, $data)
    {
        return $this->prefixImgUrl($val, $data);
    }
}
