<?php
/**
 * 文章标签验证器
 */

namespace app\common\validate;

class ArticleTagValidate extends Validate
{
    protected $rule = [
        'article_id|文章' => 'require',
        'tag_id|标签'     => 'require',

    ];

    protected $message = [
        'article_id.require' => '文章不能为空',
        'tag_id.require'     => '标签不能为空',

    ];

    protected $scene = [
        'add'  => ['article_id', 'tag_id',],
        'edit' => ['article_id', 'tag_id',],

    ];


}
