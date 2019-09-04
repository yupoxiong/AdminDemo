<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Slide extends Migrator
{

    public function change()
    {
        $table = $this->table('slide', ['comment' => '轮播', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '名称'])
            ->addColumn('img', 'string', ['limit' => 255, 'default' => '', 'comment' => '图片'])
            ->addColumn('jump_type', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '跳转类型'])  //1商品，2文章，3url
            ->addColumn('jump_target', 'string', ['limit' => 255, 'default' => '', 'comment' => '跳转目标'])  //跳转目标为数据ID或url地址
            ->addColumn('sort_number', 'integer', ['limit' => 10, 'default' => 1000, 'comment' => '排序'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
