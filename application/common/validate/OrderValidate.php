<?php
/**
 * 订单验证器
 */

namespace app\common\validate;

class OrderValidate extends Validate
{
    protected $rule = [
        'order_no|订单编号'       => 'require',
        'user_id|下单用户'        => 'require',
        'order_price|订单金额'    => 'require',
        'pay_price|支付金额'      => 'require',
        'goods_price|商品总额'    => 'require',
        'express_price|运费'    => 'require',
        'name|姓名'             => 'require',
        'mobile|手机号'          => 'require',
        'address|收货地址'        => 'require',
        'express_id|快递公司'     => 'require',
        'express_no|快递单号'     => 'require',
        'pay_channel|支付渠道'    => 'require',
        'pay_status|支付状态'     => 'require',
        'pay_time|付款时间'       => 'require',
        'deliver_status|发货状态' => 'require',
        'deliver_time|发货时间'   => 'require',
        'receive_time|收货时间'   => 'require',

    ];

    protected $message = [
        'order_no.require'       => '订单编号不能为空',
        'user_id.require'        => '下单用户不能为空',
        'order_price.require'    => '订单金额不能为空',
        'pay_price.require'      => '支付金额不能为空',
        'goods_price.require'    => '商品总额不能为空',
        'express_price.require'  => '运费不能为空',
        'name.require'           => '姓名不能为空',
        'mobile.require'         => '手机号不能为空',
        'address.require'        => '收货地址不能为空',
        'express_id.require'     => '快递公司不能为空',
        'express_no.require'     => '快递单号不能为空',
        'pay_channel.require'    => '支付渠道不能为空',
        'pay_status.require'     => '支付状态不能为空',
        'pay_time.require'       => '付款时间不能为空',
        'deliver_status.require' => '发货状态不能为空',
        'deliver_time.require'   => '发货时间不能为空',
        'receive_time.require'   => '收货时间不能为空',

    ];

    protected $scene = [
        'add'  => ['order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'address', 'express_id', 'express_no', 'pay_channel', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time',],
        'edit' => ['order_no', 'user_id', 'order_price', 'pay_price', 'goods_price', 'express_price', 'name', 'mobile', 'address', 'express_id', 'express_no', 'pay_channel', 'pay_status', 'pay_time', 'deliver_status', 'deliver_time', 'receive_time',],

    ];


}
