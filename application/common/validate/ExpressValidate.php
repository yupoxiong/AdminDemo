<?php
/**
 * 快递验证器
 */

namespace app\common\validate;

class ExpressValidate extends Validate
{
    protected $rule = [
        'name|名称' => 'require',
        'code|编码' => 'require',

    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'code.require' => '编码不能为空',

    ];

    protected $scene = [
        'add'  => ['name', 'code',],
        'edit' => ['name', 'code',],

    ];


}
