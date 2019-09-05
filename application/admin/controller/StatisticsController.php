<?php
/**
 * 统计示例控制器
 */

namespace app\admin\controller;


class StatisticsController extends Controller
{

    //统计概览
    public function index()
    {


        return $this->fetch();

    }
}