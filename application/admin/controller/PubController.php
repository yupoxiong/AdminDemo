<?php
/**
 * 公共控制器
 */

namespace app\admin\controller;


use app\common\model\Article;
use app\common\model\Goods;
use think\Request;

class PubController extends Controller
{
    protected $authExcept = [
        'admin/pub/getslidetargetdata'
    ];

    public function getSlideTargetData(Request $request)
    {
        $param = $request->param();

        switch ($param['type_id']) {
            case 1:
                $data = Goods::all();
                break;
            case 2:
                $data = Article::all();
                break;

            default:
                $data = Goods::all();
                break;

        }

        return success('success', URL_CURRENT, $data);
    }
}