<?php
/**
 * 应用设置控制器
 */

namespace app\admin\controller;

use think\Request;
use app\common\model\AppConfig;
use app\common\model\AppConfigModule;

use app\common\validate\AppConfigValidate;

class AppConfigController extends Controller
{

    //列表
    public function index(Request $request, AppConfig $model)
    {
        $param = $request->param();
        $model = $model->with('app_config_module')->scope('where', $param);

        $data = $model->paginate($this->admin['per_page'], false, ['query' => $request->get()]);
        //关键词，排序等赋值
        $this->assign($request->get());

        $this->assign([
            'data'  => $data,
            'page'  => $data->render(),
            'total' => $data->total(),
        ]);
        return $this->fetch();
    }

    //添加
    public function add(Request $request, AppConfig $model, AppConfigValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('add')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            foreach ($param['config_name'] as $key => $value) {
                if (($param['config_name'][$key]) == ''
                    || ($param['config_field'][$key] == '')
                    || ($param['config_type'][$key] == '')
                    || ($param['config_content'][$key] == '')
                ) {
                    return error('设置信息不完整');
                }

                if (in_array($param['config_type'][$key], ['select', 'multi_select', 'radio', 'checkbox']) && ($param['config_option'][$key] == '')) {
                    return error('设置信息不完整');
                }

                $content[] = [
                    'name'    => $value,
                    'field'   => $param['config_field'][$key],
                    'type'    => $param['config_type'][$key],
                    'content' => $param['config_content'][$key],
                    'option'  => $param['config_option'][$key],
                ];

            }

            $param['content'] = $content;

            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && $param['_create'] == 1) {
                $url = URL_RELOAD;
            }

            return $result ? success('添加成功', $url) : error();
        }

        $this->assign([
            'app_config_module_list' => AppConfigModule::all(),

        ]);


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, AppConfig $model, AppConfigValidate $validate)
    {

        $data = $model::get($id);
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('edit')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            foreach ($param['config_name'] as $key => $value) {
                if (($param['config_name'][$key]) == ''
                    || ($param['config_field'][$key] == '')
                    || ($param['config_type'][$key] == '')
                    || ($param['config_content'][$key] == '')
                ) {
                    return error('设置信息不完整');
                }

                if (in_array($param['config_type'][$key], ['select', 'multi_select', 'radio', 'checkbox']) && ($param['config_option'][$key] == '')) {
                    return error('设置信息不完整');
                }

                $content[] = [
                    'name'    => $value,
                    'field'   => $param['config_field'][$key],
                    'type'    => $param['config_type'][$key],
                    'content' => $param['config_content'][$key],
                    'option'  => $param['config_option'][$key],
                ];

            }

            $param['content'] = $content;

            $result = $data->save($param);
            return $result ? success() : error();
        }

        $this->assign([
            'data'                   => $data,
            'app_config_module_list' => AppConfigModule::all(),

        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, AppConfig $model)
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
