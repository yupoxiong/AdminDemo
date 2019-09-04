<?php
/**
 * 文章分类验证器
 */

namespace app\common\validate;

class ArticleCategoryValidate extends Validate
{
    protected $rule = [
        'parent_id|上级分类' => 'require',
        'name|名称'        => 'require',

    ];

    protected $message = [
        'parent_id.require' => '上级分类不能为空',
        'name.require'      => '名称不能为空',

    ];

    protected $scene = [
        'add'  => ['parent_id', 'name',],
        'edit' => ['parent_id', 'name',],

    ];


}
