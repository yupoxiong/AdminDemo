<?php
/**
 * 职位模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Position extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'position';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];


    //关联员工
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }


}
