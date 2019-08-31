<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ArticleComment extends Migrator
{
    public function change()
    {
        $table = $this->table('article_comment', ['comment'=>'文章评论','engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '评论用户'])
            ->addColumn('parent_id', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '父级评论'])
            ->addColumn('content', 'string', ['limit' => 300, 'default' => '', 'comment' => '评论内容'])
            ->addColumn('create_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 10, 'default' => 0, 'comment' => '删除时间'])
            ->create();
    }
}
