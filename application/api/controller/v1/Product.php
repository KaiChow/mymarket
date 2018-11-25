<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\exception\MissException;
use app\api\validate\Count;

use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;
use think\Collection;


class Product extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function getProductRecent($count = 15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()) {
            throw new MissException();
        }
        //此处没有使用成collection，后期补上--！！！！  在database设置里返回类型为collection
        $result = $products->hidden(['summary']);

        return $result;
    }

    public function getAllInCategory($id)
    {
        $products = ProductModel::getProductByCategoryID($id);
        if ($products->isEmpty()) {
            throw new MissException();
        }

        return $products;

    }

    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductDetails($id);
        if (empty($product)) {
            throw new MissException();
        }
        return $product;
    }


}
