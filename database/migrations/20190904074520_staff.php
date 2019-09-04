<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Staff extends Migrator
{

    public function change()
    {
        $table = $this->table('staff', ['comment' => '员工', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('avatar', 'string', ['limit' => 255, 'default' => '', 'comment' => '照片'])
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '姓名'])
            ->addColumn('department_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '部门'])
            ->addColumn('position_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '职位'])
            ->addColumn('job_number', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '工号'])
            ->addColumn('mobile', 'string', ['limit' => 11, 'default' => '', 'comment' => '手机号'])
            ->addColumn('email', 'string', ['limit' => 100, 'default' => '', 'comment' => '邮箱'])
            ->addColumn('birthday', 'date', [  'comment' => '生日'])
            ->addColumn('hired_date', 'date', [  'comment' => '入职日期'])
            ->addColumn('is_boss', 'boolean', ['limit' => 1, 'default' => 0, 'comment' => '是否为老板'])
            ->addColumn('is_leader', 'boolean', ['limit' => 1, 'default' => 0, 'comment' => '是否所属部门领导'])
            ->addColumn('sort_number', 'integer', ['limit' => 10, 'default' => 1000, 'comment' => '排序'])
            ->addColumn('status', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '是否启用'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
