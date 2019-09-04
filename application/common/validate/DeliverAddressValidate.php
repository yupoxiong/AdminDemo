<?php
/**
 * 收货地址验证器
 */

namespace app\common\validate;

class DeliverAddressValidate extends Validate
{
    protected $rule = [
        'user_id|用户'      => 'require',
        'name|姓名'         => 'require',
        'mobile|手机号'      => 'require',
        'province_id|省'   => 'require',
        'city_id|市'       => 'require',
        'district_id|区'   => 'require',
        'street_id|街道'    => 'require',
        'detail|详细地址'     => 'require',
        'is_default|是否默认' => 'require',

    ];

    protected $message = [
        'user_id.require'     => '用户不能为空',
        'name.require'        => '姓名不能为空',
        'mobile.require'      => '手机号不能为空',
        'province_id.require' => '省不能为空',
        'city_id.require'     => '市不能为空',
        'district_id.require' => '区不能为空',
        'street_id.require'   => '街道不能为空',
        'detail.require'      => '详细地址不能为空',
        'is_default.require'  => '是否默认不能为空',

    ];

    protected $scene = [
        'add'  => ['user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default',],
        'edit' => ['user_id', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'street_id', 'detail', 'is_default',],

    ];


}
