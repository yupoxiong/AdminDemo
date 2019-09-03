<?php
/**
 * 微信相关功能
 */

namespace app\admin\controller;


use EasyWeChat\Factory;

class WeChatController
{

    //服务端验证
    public function index()
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
            return "您好！欢迎使用 EasyWeChat!";
        });

        $response = $app->server->serve();

        // 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
    }


}