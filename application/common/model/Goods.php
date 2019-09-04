<?php
/**
 * 商品模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Goods extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'goods';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    //是否上架获取器
    public function getStatusTextAttr($value, $data)
    {
        return self::BOOLEAN_TEXT[$data['status']];
    }

    //关联商品分类
    public function goodsCategory()
    {
        return $this->belongsTo(GoodsCategory::class);
    }//关联品牌

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
