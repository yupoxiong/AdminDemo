<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AppConfigModule extends Migrator
{

    public function change()
    {

        $table = $this->table('app_config_module', ['comment' => '应用设置模块', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '模块名称'])
            ->addColumn('code', 'string', ['limit' => 50, 'default' => '', 'comment' => '代码'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
