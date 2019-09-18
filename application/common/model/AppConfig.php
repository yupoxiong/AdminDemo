<?php
/**
 * 应用设置模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class AppConfig extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'app_config';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name', 'code',];


    //关联应用设置模块
    public function appConfigModule()
    {
        return $this->belongsTo(AppConfigModule::class);
    }

    public function setContentAttr($value)
    {
        return json_encode($value);
    }

    public function getContentAttr($value)
    {
        return json_decode($value, true);
    }

}
