<?php
/**
 * 文章
 */
use think\migration\Migrator;
use think\migration\db\Column;

class Article extends Migrator
{

    public function change()
    {
        $table = $this->table('article', ['comment' => '文章', 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('name', 'string', ['limit' => 30, 'default' => '', 'comment' => '标题'])
            ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '发布人'])
            ->addColumn('article_category_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '所属分类'])
            ->addColumn('description', 'string', ['limit' => 50, 'default' => '', 'comment' => '简介'])
            ->addColumn('content', 'text', [ 'comment' => '内容'])
            ->addColumn('is_top', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '是否置顶'])
            ->addColumn('is_hot', 'boolean', ['limit' => 1, 'default' => 1, 'comment' => '是否热门'])
            ->addColumn('img', 'string', ['limit' => 255, 'default' => '', 'comment' => '缩略图'])
            ->addColumn('sort_number', 'integer', ['limit' => 10, 'default' => 1000, 'comment' => '排序'])
            ->addColumn('view_count', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '浏览数'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '发布时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();

    }
}
