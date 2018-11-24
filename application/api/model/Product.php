<?php

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time', 'main_img_id', 'create_time', 'from', 'category_id', 'pivot'];

    public function getMainImgUrlAttr($val, $data)
    {
        return $this->prefixImgUrl($val, $data);
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)->order('create_time', 'desc')->select();
        return $products;
    }

    public static function getProductByCategoryID($id)
    {
        return self::where('category_id', '=', $id)->select();
    }
}
