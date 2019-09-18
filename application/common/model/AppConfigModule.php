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

    

    //关联应用设置
public function appConfig()
{
    return $this->hasMany(AppConfig::class);
}

    
}
