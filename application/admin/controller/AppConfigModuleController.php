<?php
/**
 * 应用设置模块控制器
 */

namespace app\admin\controller;

use think\Request;
use app\common\model\AppConfigModule;

use app\common\validate\AppConfigModuleValidate;

class AppConfigModuleController extends Controller
{

    //列表
    public function index(Request $request, AppConfigModule $model)
    {
        $param = $request->param();
        $model = $model->scope('where', $param);

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
    public function add(Request $request, AppConfigModule $model, AppConfigModuleValidate $validate)
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


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, AppConfigModule $model, AppConfigModuleValidate $validate)
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
            'data' => $data,

        ]);
        return $this->fetch('add');

    }


    //生成配置文件，配置文件名为模块名
    public function file($id,  AppConfigModule $model)
    {
        $data = $model::get($id);

        $app_config = $data->appConfig;

        $file_name = $data->code.'.test.php';

        $all_file_name = app()->getConfigPath().$file_name;

        $is_warning = cache('app_config_'.$data->code);

        $is_have = file_exists($all_file_name);
        if(!$is_warning && $is_have){

            cache('app_config_'.$data->code,'1',5);
            return error('当前配置文件已存在，如果确认要生成请在5秒内再次点击生成按钮');
        }

        $codes = "<?php\r\n\r\n/**\r\n* ".$data->name."\r\n* 此配置文件为自动生成，生成时间".date('Y-m-d H:i:s')."\r\n*/\r\n\r\nreturn [";
        foreach ($app_config as $key=>$value){
            $codes.="\r\n    //".$value['name']."\r\n    '".$value['code']."'=>[";
            foreach ($value->content as $content){
                $codes.="\r\n    //".$content['name']."\r\n    '".$content['field']."'=>'".$content['content']."',";
            }
            $codes.="\r\n],";
        }
        $codes.="\r\n];";
        $result = file_put_contents($all_file_name,$codes);
        return $result ? success('生成成功',URL_RELOAD) : error('生成失败');

    }


    //删除
    public function del($id, AppConfigModule $model)
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

        //删除限制
        $relation_name    = 'appConfig';
        $relation_cn_name = '应用设置';
        $tips             = '下有' . $relation_cn_name . '数据，请删除' . $relation_cn_name . '数据后再进行删除操作';
        if (is_array($id)) {
            foreach ($id as $item) {
                $data = $model::get($item);
                if ($data->$relation_name->count() > 0) {
                    return error($data->name . $tips);
                }
            }
        } else {
            $data = $model::get($id);
            if ($data->$relation_name->count() > 0) {
                return error($data->name . $tips);
            }
        }

        if ($model->softDelete) {
            $result = $model->whereIn('id', $id)->useSoftDelete('delete_time', time())->delete();
        } else {
            $result = $model->whereIn('id', $id)->delete();
        }

        return $result ? success('操作成功', URL_RELOAD) : error();
    }


    protected function strReplaceFirst($search, $replace, $subject) {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

}
