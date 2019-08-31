<?php
/**
 * 文章分类
 */
use think\migration\Migrator;
use think\migration\db\Column;

class ArticleCategory extends Migrator
{

    public function change()
    {
        $table = $this->table('article_category', ['comment'=>'文章分类','engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('parent_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '上级分类'])
            ->addColumn('name', 'string', ['limit' => 50, 'default' => '', 'comment' => '名称'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
