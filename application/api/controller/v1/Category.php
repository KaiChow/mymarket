<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23 0023
 * Time: 21:03
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\exception\MissException;
use app\api\model\Category as CategoryModel;

class Category extends BaseController
{

    public function getAllCategories()
    {
        $categories = CategoryModel::all([], 'img');

        if (empty($categories)) {
            throw new MissException('类型不存在','100001');
        }
        return $categories;
    }

}