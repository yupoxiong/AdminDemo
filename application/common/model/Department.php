<?php
/**
 * 部门模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Department extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'department';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    //关联用户
    public function user()
    {
        return $this->hasMany(User::class);
    }


}
