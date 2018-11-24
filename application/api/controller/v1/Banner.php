<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/11/23
 * Time: 16:36
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;


class Banner extends BaseController
{
    public function getBanner()
    {

        (new IDMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBannerByID($this->request->param('id'));
        return $banner;
    }
}