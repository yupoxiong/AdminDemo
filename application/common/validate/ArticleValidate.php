<?php
/**
 * 文章验证器
 */

namespace app\common\validate;

class ArticleValidate extends Validate
{
    protected $rule = [
        'name|标题'                  => 'require',
        'user_id|发布人'              => 'require',
        'article_category_id|所属分类' => 'require',
        'description|简介'           => 'require',
        'content|内容'               => 'require',
        'is_top|是否置顶'              => 'require',
        'is_hot|是否热门'              => 'require',
        'sort_number|排序'           => 'require',
        'view_count|浏览数'           => 'require',

    ];

    protected $message = [
        'name.require'                => '标题不能为空',
        'user_id.require'             => '发布人不能为空',
        'article_category_id.require' => '所属分类不能为空',
        'description.require'         => '简介不能为空',
        'content.require'             => '内容不能为空',
        'is_top.require'              => '是否置顶不能为空',
        'is_hot.require'              => '是否热门不能为空',
        'sort_number.require'         => '排序不能为空',
        'view_count.require'          => '浏览数不能为空',

    ];

    protected $scene = [
        'add'  => ['name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'sort_number', 'view_count',],
        'edit' => ['name', 'user_id', 'article_category_id', 'description', 'content', 'is_top', 'is_hot', 'sort_number', 'view_count',],

    ];


}
