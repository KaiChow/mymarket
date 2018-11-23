<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{
    //隐藏数据
    protected $hidden = ['update_time','delete_time','banner_id','img_id','type','id'];

    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}
