<?php
/**
 * 品牌验证器
 */

namespace app\common\validate;

class BrandValidate extends Validate
{
    protected $rule = [
        'name|名称' => 'require',

    ];

    protected $message = [
        'name.require' => '名称不能为空',

    ];

    protected $scene = [
        'add'  => ['name',],
        'edit' => ['name',],

    ];


}
