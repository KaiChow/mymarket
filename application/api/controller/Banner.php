<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/11/23
 * Time: 16:36
 */

namespace app\api\controller;


use app\api\validate\IDMustBePositiveInt;
use think\Controller;
use app\api\model\Banner as BannerModel;

class Banner extends Controller
{
    public function getBanner()
    {

        (new IDMustBePositiveInt())->goCheck();

        return BannerModel::getBannerByID($this->request->param('id'));
    }
}