<?php

namespace app\api\model;

use think\Model;

class Category extends Model
{
    //
    public static function getAllCategory()
    {
       return  self::all();
    }
}
