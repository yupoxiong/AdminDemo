<?php
/**
 * 轮播模型
 */

namespace app\common\model;

use think\model\concern\SoftDelete;

class Slide extends Model
{
    use SoftDelete;
    public $softDelete = true;
    protected $name = 'slide';
    protected $autoWriteTimestamp = true;

    //可搜索字段
    protected $searchField = ['name',];

    public $jumpType = [
        ['id' => 1, 'name' => '商品'],
        ['id' => 2, 'name' => '文章'],
        ['id' => 3, 'name' => '网址'],
    ];


    public function getJumpTypeTextAttr($value, $data)
    {
        $result = '--';
        foreach ($this->jumpType as $item) {
            if ($data['jump_type'] == $item['id']) {
                $result = $item['name'];
                break;
            }
        }

        return $result;
    }

    public function getJumpTargetTextAttr($value, $data)
    {
        $result = '--';
        switch ($data['jump_type']) {
            case 1:
                $result = Goods::where('id', $data['jump_target'])->value('name');
                break;
            case 2:
                $result = Article::where('id', $data['jump_target'])->value('name');
                break;
            case 3:
                $result = $data['jump_target'];
                break;
            default:
                break;
        }

        return $result;
    }

}
