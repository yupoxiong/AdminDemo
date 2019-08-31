<?php

use think\migration\Migrator;
use think\migration\db\Column;

class DeliverAddress extends Migrator
{

    public function change()
    {
        $table = $this->table('deliver_address', ['comment'=>'收货地址','engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '用户'])
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '姓名'])
            ->addColumn('mobile', 'string', ['limit' => 11, 'default' => '', 'comment' => '手机号'])
            ->addColumn('province_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '省'])
            ->addColumn('city_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '市'])
            ->addColumn('district_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '区'])
            ->addColumn('street_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '街道'])
            ->addColumn('detail', 'string', ['limit' => 100, 'default' => '', 'comment' => '详细地址'])
            ->addColumn('is_default', 'boolean', ['limit' => 1, 'default' => 0, 'comment' => '是否默认'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
