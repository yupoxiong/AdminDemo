<?php
/**
 * 商品分类控制器
 */

namespace app\admin\controller;

use think\Request;
use app\common\model\GoodsCategory;

use app\common\validate\GoodsCategoryValidate;

class GoodsCategoryController extends Controller
{

    //列表
    public function index(GoodsCategory $model)
    {
        $data = $this->getTreeList($model);

        $this->assign([
            'data' => $data,
        ]);
        return $this->fetch();
    }

    //添加
    public function add(Request $request, GoodsCategory $model, GoodsCategoryValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('add')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && $param['_create'] == 1) {
                $url = URL_RELOAD;
            }

            return $result ? success('添加成功', $url) : error();
        }

        $this->assign([
            'cat_list' => $this->getSelectList($model),
        ]);

        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, GoodsCategory $model, GoodsCategoryValidate $validate)
    {

        $data = $model::get($id);
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('edit')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            $result = $data->save($param);
            return $result ? success() : error();
        }

        $this->assign([
            'data'     => $data,
            'cat_list' => $this->getSelectList($model, $data->parent_id),

        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, GoodsCategory $model)
    {
        if (count($model->noDeletionId) > 0) {
            if (is_array($id)) {
                if (array_intersect($model->noDeletionId, $id)) {
                    return error('ID为' . implode(',', $model->noDeletionId) . '的数据无法删除');
                }
            } else if (in_array($id, $model->noDeletionId)) {
                return error('ID为' . $id . '的数据无法删除');
            }
        }

        if ($model->softDelete) {
            $result = $model->whereIn('id', $id)->useSoftDelete('delete_time', time())->delete();
        } else {
            $result = $model->whereIn('id', $id)->delete();
        }

        return $result ? success('操作成功', URL_RELOAD) : error();
    }

}
