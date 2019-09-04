<?php
/**
 * 订单商品验证器
 */

namespace app\common\validate;

class OrderGoodsValidate extends Validate
{
    protected $rule = [
        'order_id|所属订单'  => 'require',
        'goods_id|商品'    => 'require',
        'number|数量'      => 'require',
        'attr|规格'        => 'require',
        'price|单价'       => 'require',
        'total_price|总价' => 'require',

    ];

    protected $message = [
        'order_id.require'    => '所属订单不能为空',
        'goods_id.require'    => '商品不能为空',
        'number.require'      => '数量不能为空',
        'attr.require'        => '规格不能为空',
        'price.require'       => '单价不能为空',
        'total_price.require' => '总价不能为空',

    ];

    protected $scene = [
        'add'  => ['order_id', 'goods_id', 'number', 'attr', 'price', 'total_price',],
        'edit' => ['order_id', 'goods_id', 'number', 'attr', 'price', 'total_price',],

    ];


}
