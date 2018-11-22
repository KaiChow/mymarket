<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/11/22
 * Time: 14:58
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Banner as BannerModel;

class Banner extends BaseController
{
    public function getBanner()
    {
        $id = $this->request->param('id');
        $banner = BannerModel::getBannerByID($id);
        return ['code' => 1, 'data' => $banner];
    }

}