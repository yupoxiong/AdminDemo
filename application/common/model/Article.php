<?php
/**
 * 文章模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'article';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name', 'description',];

    //是否置顶获取器
    public function getIsTopTextAttr($value, $data)
    {
        return self::BOOLEAN_TEXT[$data['is_top']];
    }//是否热门获取器

    public function getIsHotTextAttr($value, $data)
    {
        return self::BOOLEAN_TEXT[$data['is_hot']];
    }

    //关联用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }//关联文章分类

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }


    public function tag()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class);
    }

}
