<?php
/**
 * 应用设置模块模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class AppConfigModule extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'app_config_module';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    //保护前5个不被删除
    public $noDeletionId = [1,2,3,4,5];

    //关联应用设置
    public function appConfig()
    {
        return $this->hasMany(AppConfig::class);
    }


}
