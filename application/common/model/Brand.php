<?php
/**
 * 品牌模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Brand extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'brand';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];


    //关联商品
    public function goods()
    {
        return $this->hasMany(Goods::class);
    }

}
