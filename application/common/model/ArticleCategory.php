<?php
/**
 * 文章分类模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class ArticleCategory extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'article_category';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    //关联文章
    public function article()
    {
        return $this->hasMany(Article::class);
    }

}
