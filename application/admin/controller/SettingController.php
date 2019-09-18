<?php
/**
 * 设置中心控制器
 * "//code_start//" 为自动生成设置方法标记，请勿删除
 */

namespace app\admin\controller;

use app\common\model\AppConfig;

class SettingController extends Controller
{



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

                $form_data = [
                    'form_type'     => $content['type'],
                    'form_name'     => $content['name'],
                    'field_name'    => $content['field'],
                    'field_default' => $content['content'],
                ];

                if($form_data['form_type']==='switch'){
                    $form_data['form_type'] = 'switch_field';
                }

                if($form_data['form_type']==='select'){
                    $form_data['relation_data']='';
                }


                //$arr = explode("\r\n",$item['option']);

                $class_name      = parse_name($form_data['form_type'], 1);
                $class           = '\\generate\\field\\' . $class_name;
                $content['form'] = $class::create($form_data);

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
    public function update()
    {

        return error();
    }



}