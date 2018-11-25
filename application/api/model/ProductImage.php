<?php

namespace app\api\model;

use think\Model;

class ProductImage extends Model
{
    //

    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}
