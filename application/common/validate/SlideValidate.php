<?php
/**
 * 轮播验证器
 */

namespace app\common\validate;

class SlideValidate extends Validate
{
    protected $rule = [
        'name|名称'          => 'require',
        'jump_type|跳转类型'   => 'require',
        'jump_target|跳转目标' => 'require',
        'sort_number|排序'   => 'require',

    ];

    protected $message = [
        'name.require'        => '名称不能为空',
        'jump_type.require'   => '跳转类型不能为空',
        'jump_target.require' => '跳转目标不能为空',
        'sort_number.require' => '排序不能为空',

    ];

    protected $scene = [
        'add'  => ['name', 'jump_type', 'jump_target', 'sort_number',],
        'edit' => ['name', 'jump_type', 'jump_target', 'sort_number',],

    ];


}
