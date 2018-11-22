<?php

namespace app\api\model;


class Image extends BaseModel
{
    //
    protected  $hidden = ['update_time','delete_time'];
    public function getUrlAttr($val)
    {
        if( $val ){

        }
        return 'wwww.baidu.com/img'.$val;
    }
}
