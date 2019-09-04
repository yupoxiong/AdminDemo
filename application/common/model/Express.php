<?php
/**
 * 快递模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Express extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'express';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    //关联订单
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
