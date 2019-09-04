<?php
/**
 * 部门验证器
 */

namespace app\common\validate;

class DepartmentValidate extends Validate
{
    protected $rule = [
        'parent_id|上级部门' => 'require',
        'name|名称'        => 'require',

    ];

    protected $message = [
        'parent_id.require' => '上级部门不能为空',
        'name.require'      => '名称不能为空',

    ];

    protected $scene = [
        'add'  => ['parent_id', 'name',],
        'edit' => ['parent_id', 'name',],

    ];


}
