<?php

use think\migration\Migrator;
use think\migration\db\Column;

class OrderGoods extends Migrator
{

    public function change()
    {
        $table = $this->table('order_goods', ['comment'=>'订单商品','engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('order_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '所属订单'])
            ->addColumn('goods_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '商品'])
            ->addColumn('number', 'integer', ['limit' => 10, 'default' => 1, 'comment' => '数量'])
            ->addColumn('attr', 'string', ['limit' => 200, 'default' => '', 'comment' => '规格'])
            ->addColumn('price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '单价'])
            ->addColumn('total_price', 'decimal', ['precision' => 14, 'scale' => 2, 'default' => 0, 'comment' => '总价'])

            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
