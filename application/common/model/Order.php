<?php
/**
 * 订单模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;
use yupoxiong\region\model\Region;

class Order extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'order';
    protected $autoWriteTimestamp = true;

    const PAY_STATUS = [
        0 => '未支付',
        1 => '已支付',
    ];

    const DELIVER_STATUS = [
        0 => '未发货',
        1 => '运输中',
        2 => '已收货',
    ];

    const PAY_CHANNEL_TEXT = [
        1 => '支付宝',
        2 => '微信',
    ];


    //可搜索字段
    protected $searchField = ['order_no', 'mobile',];

    //付款时间获取器
    public function getPayTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    //付款时间修改器
    public function setPayTimeAttr($value)
    {
        return strtotime($value);
    }//发货时间获取器

    public function getDeliverTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    //发货时间修改器
    public function setDeliverTimeAttr($value)
    {
        return strtotime($value);
    }//收货时间获取器

    public function getReceiveTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
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

    public function getPayStatusTextAttr($value, $data)
    {
        return self::PAY_STATUS[$data['pay_status']];
    }

    public function getDeliverStatusTextAttr($value, $data)
    {
        return self::DELIVER_STATUS[$data['deliver_status']];
    }

    public function getPayChannelTextAttr($value, $data)
    {
        return self::PAY_CHANNEL_TEXT[$data['pay_channel']];
    }

    public function orderGoods()
    {
        return $this->hasMany(OrderGoods::class);
    }

    //关联省
    public function province()
    {
        return $this->belongsTo(Region::class, 'province_id');
    }

    //关联市
    public function city()
    {
        return $this->belongsTo(Region::class, 'city_id');
    }

    //关联区县
    public function district()
    {
        return $this->belongsTo(Region::class, 'district_id');
    }

    //关联街道
    public function street()
    {
        return $this->belongsTo(Region::class, 'street_id');
    }

}
