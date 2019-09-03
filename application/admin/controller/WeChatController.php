<?php
/**
 * 微信相关功能
 */

namespace app\admin\controller;


use EasyWeChat\Factory;

class WeChatController extends Controller
{

    //功能概述
    public function index()
    {
        return $this->fetch();
    }

    //服务端验证
    public function server()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        $response = $app->server->serve();

        // 将响应输出
        return $response->send();
    }

    //接收 & 回复用户消息
    public function msg()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            return "你好哇";
        });

        $response = $app->server->serve();

        // 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
    }

    //获取用户信息
    public function user()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);
        $user = $app->user->get('用户的openID');

    }


}