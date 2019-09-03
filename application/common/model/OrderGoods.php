<?php
/**
 * 订单商品模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class OrderGoods extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'order_goods';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = [];

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }


}
