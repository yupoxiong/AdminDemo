<?php
/**
 * 设置中心控制器
 * "//code_start//" 为自动生成设置方法标记，请勿删除
 */

namespace app\admin\controller;

use app\common\model\AppConfig;

use app\admin\traits\FormHtml;
use think\Request;

class SettingController extends Controller
{

    use FormHtml;


    //设置展示页面
    public function index()
    {

        return $this->fetch();
    }


    public function admin()
    {
        return $this->show(1);
    }


    protected function show($id)
    {
        $data = AppConfig::where('app_config_module_id', $id)->select();

        foreach ($data as $key => $value) {

            $content_new = [];

            foreach ($value->content as $kk => $content) {

                $content['form'] = $this->getFieldForm($content['type'], $content['name'], $content['field'], $content['content'], $content['option']);

                $content_new[] = $content;
            }

            $value->content = $content_new;
        }


        $this->assign([
            'data_config' => $data,
        ]);

        return $this->fetch('show');
    }


    //更新设置
    public function update(Request $request, AppConfig $model)
    {
        $param = $request->param();

        $id = $param['id'];

        $config = $model::get($id);

        $content_data = [];
        foreach ($config->content as $key => $value) {

            switch ($value['type']) {
                case 'image' :
                case 'file':

                    //处理图片上传
                    if (!empty($_FILES[$value['field']]['name'])) {
                        $attachment = new \app\common\model\Attachment;
                        $file       = $attachment->upload($value['field']);
                        if ($file) {
                            $value['content'] = $param[$value['field']] = $file->url;
                        }
                    }
                    break;

                case 'multi_file':
                case 'multi_image':

                    if (!empty($_FILES[$value['field']]['name'])) {
                        $attachment = new \app\common\model\Attachment;
                        $file       = $attachment->uploadMulti($value['field']);
                        if ($file) {
                            $value['content'] = $param[$value['field']] = json_encode($file);
                        }
                    }
                    break;

                default:
                    $value['content'] = $param[$value['field']];
                    break;
            }

            $content_data[] = $value;
        }

        $config->content = $content_data;
        $result          = $config->save();

        return $result ? success('修改成功', URL_RELOAD) : error();

    }


}