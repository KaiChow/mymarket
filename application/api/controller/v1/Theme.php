<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\exception\MissException;
use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;

class Theme extends BaseController
{
    /**
     * 显示资源列表
     * @url theme?ids=id1,id2,id3
     * @return \think\Response
     */
    public function getSingleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);

        $result = ThemeModel::with('headImg,topicImg')->select($ids);
        if (empty($result)) {
            throw new MissException();
        }
        return $result;

    }

    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $result = ThemeModel::with('products,headImg,topicImg')->find($id);
        if (empty($result)) {
            throw new MissException();
        }
        return $result;
    }


}
