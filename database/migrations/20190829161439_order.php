<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Order extends Migrator
{

    public function change()
    {

        $table = $this->table('order', ['comment' => '订单', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('order_no', 'string', ['limit' => 50, 'default' => '', 'comment' => '订单编号'])
            ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '下单用户'])
            ->addColumn('order_price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '订单金额'])
            ->addColumn('pay_price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '支付金额'])
            ->addColumn('goods_price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '商品总额'])
            ->addColumn('express_price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '运费'])
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '姓名'])
            ->addColumn('mobile', 'string', ['limit' => 11, 'default' => '', 'comment' => '手机号'])
            ->addColumn('province_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '省'])
            ->addColumn('city_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '市'])
            ->addColumn('district_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '区县'])
            ->addColumn('street_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '街道'])
            ->addColumn('address', 'string', ['limit' => 200, 'default' => '', 'comment' => '收货地址'])
            ->addColumn('full_address', 'string', ['limit' => 500, 'default' => '', 'comment' => '完整收货地址'])
            ->addColumn('express_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '快递公司'])
            ->addColumn('express_no', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '快递单号'])
            ->addColumn('pay_channel', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '支付渠道'])// 1支付宝，2微信，3余额
            ->addColumn('pay_status', 'boolean', ['limit' => 1, 'default' => 0, 'comment' => '支付状态'])
            ->addColumn('pay_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '付款时间'])
            ->addColumn('deliver_status', 'boolean', ['limit' => 1, 'default' => 0, 'comment' => '发货状态'])// 0未发货，1已发货，2已收货
            ->addColumn('deliver_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '发货时间'])
            ->addColumn('receive_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '收货时间'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
