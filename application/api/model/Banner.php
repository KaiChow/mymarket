<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/11/23
 * Time: 16:46
 */

namespace app\api\model;


use app\api\exception\MissException;
use think\Model;

class Banner extends Model
{
    public static function getBannerByID($id)
    {
        $banner = self::get($id);

        if(!$banner){
            throw new MissException();
        }
        return $banner;
    }

}