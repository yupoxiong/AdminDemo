<?php
/**
 * 收货地址模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;
use yupoxiong\region\model\Region;

class DeliverAddress extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'deliver_address';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name', 'mobile',];

    //是否默认获取器
    public function getIsDefaultTextAttr($value, $data)
    {
        return self::BOOLEAN_TEXT[$data['is_default']];
    }

    //关联用户
    public function user()
    {
        return $this->belongsTo(User::class);
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
