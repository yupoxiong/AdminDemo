<?php
/**
 * 订单模型
*/

namespace app\common\model;

use think\model\concern\SoftDelete;

class Order extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'order';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name','mobile',];

    //付款时间获取器
public function getPayTimeAttr($value)
{
    return date('Y-m-d H:i:s',$value);
}

//付款时间修改器
public function setPayTimeAttr($value)
{
    return strtotime($value);
}//发货时间获取器
public function getDeliverTimeAttr($value)
{
    return date('Y-m-d H:i:s',$value);
}

//发货时间修改器
public function setDeliverTimeAttr($value)
{
    return strtotime($value);
}//收货时间获取器
public function getReceiveTimeAttr($value)
{
    return date('Y-m-d H:i:s',$value);
}

//收货时间修改器
public function setReceiveTimeAttr($value)
{
    return strtotime($value);
}

    //关联用户
public function user()
{
    return $this->belongsTo(User::class);
}//关联快递
public function express()
{
    return $this->belongsTo(Express::class);
}

    
}
