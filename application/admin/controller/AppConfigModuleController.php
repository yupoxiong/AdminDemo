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

        $is_have = file_exists($all_file_name);
        if($is_have){

            //当前有该文件，会导致覆盖
            //dump($is_have);
        }

        $config_array = [];


        $codes = "<?php\n/**\n* ".$data->name.'配置文件'."\n*/\nreturn [\n";

        foreach ($app_config as $key=>$value){

            $codes.="\n    //".$value['name']."\n    '".$value['code']."'=>[";
            $content_data = [];
            foreach ($value->content as $content){
                $codes.="\n    //".$content['name']."\n    '".$content['field']."'=>'".$content['content']."',";
                $content_data[$content['field']] =$content['content'];
            }

            $codes.="\n],";
            $config_array[$value['code']]=$content_data;
        }
        $codes.="\n];";
        dump($codes);

        $code = var_export($config_array,true);
        $code = str_replace(array("array (\n", "),\n", "\n)"), array("[\n", "],\n", "\n]"), $code);

        $code =  $content="<?php\r\n//".$data->name.'配置文件'."\r\nreturn ".$code.';';
        $result = file_put_contents($all_file_name,$code);

        //return $result ? success('生成成功',URL_RELOAD) : error('生成失败');

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
