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
    protected $hidden = ['update_time','delete_time'];
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerByID($id)
    {
        $banner = self::with(['items','items.img'])->find($id);

        if(!$banner){
            throw new MissException();
        }
        return $banner;
    }

}