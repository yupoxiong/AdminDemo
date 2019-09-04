<?php
/**
 * 标签模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Tag extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'tag';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    public function article()
    {
        return $this->belongsToMany(Article::class, ArticleTag::class);
    }


}
