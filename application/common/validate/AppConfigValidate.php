<?php
/**
 * 应用设置验证器
 */

namespace app\common\validate;

class AppConfigValidate extends Validate
{
    protected $rule = [
            'app_config_module_id|所属设置模块' => 'require',
    'name|名称' => 'require',
    'code|代码' => 'require',

    ];

    protected $message = [
            'app_config_module_id.require' => '所属设置模块不能为空',
    'name.require' => '名称不能为空',
    'code.require' => '代码不能为空',

    ];

    protected $scene = [
        'add'  => ['app_config_module_id','name','code',],
'edit' => ['app_config_module_id','name','code',],

    ];

    

}
