<?php
/**
 * 商品验证器
 */

namespace app\common\validate;

class GoodsValidate extends Validate
{
    protected $rule = [
        'goods_category_id|所属分类' => 'require',
        'brand_id|品牌'            => 'require',
        'name|名称'                => 'require',
        'origin_price|原价'        => 'require',
        'price|售价'               => 'require',
        'attr|规格'                => 'require',
        'detail|详情'              => 'require',
        'weight|重量'              => 'require',
        'stock|库存'               => 'require',
        'sort_number|排序(升序'      => 'require',
        'status|是否上架'            => 'require',

    ];

    protected $message = [
        'goods_category_id.require' => '所属分类不能为空',
        'brand_id.require'          => '品牌不能为空',
        'name.require'              => '名称不能为空',
        'origin_price.require'      => '原价不能为空',
        'price.require'             => '售价不能为空',
        'attr.require'              => '规格不能为空',
        'detail.require'            => '详情不能为空',
        'weight.require'            => '重量不能为空',
        'stock.require'             => '库存不能为空',
        'sort_number.require'       => '排序(升序不能为空',
        'status.require'            => '是否上架不能为空',

    ];

    protected $scene = [
        'add'  => ['goods_category_id', 'brand_id', 'name', 'origin_price', 'price', 'attr', 'detail', 'weight', 'stock', 'sort_number', 'status',],
        'edit' => ['goods_category_id', 'brand_id', 'name', 'origin_price', 'price', 'attr', 'detail', 'weight', 'stock', 'sort_number', 'status',],

    ];


}
