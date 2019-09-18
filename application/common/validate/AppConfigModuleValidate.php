<?php
/**
 * 应用设置模块验证器
 */

namespace app\common\validate;

class AppConfigModuleValidate extends Validate
{
    protected $rule = [
            'name|模块名称' => 'require',

    ];

    protected $message = [
            'name.require' => '模块名称不能为空',

    ];

    protected $scene = [
        'add'  => ['name',],
'edit' => ['name',],

    ];

    

}
