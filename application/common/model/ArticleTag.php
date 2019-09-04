<?php
/**
 * 文章标签模型
 */

namespace app\common\model;

use think\model\Pivot;

class ArticleTag extends Pivot
{
    protected $name = 'article_tag';

}
