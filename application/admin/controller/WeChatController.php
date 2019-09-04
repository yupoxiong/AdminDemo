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

        $app  = Factory::officialAccount($config);
        $user = $app->user->get('用户的openID');

    }


    //发送模版消息
    public function templateMsg()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        $app->template_message->send([
            'touser'      => 'user-openid',
            'template_id' => 'template-id',
            'url'         => 'https://easywechat.org',
            'miniprogram' => [
                'appid'    => 'xxxxxxx',
                'pagepath' => 'pages/xxx',
            ],
            'data'        => [
                'key1' => 'VALUE',
                'key2' => 'VALUE2',
            ],
        ]);
    }


    //拉黑用户
    public function block()
    {
        $config = config('wechat.');

        $app = Factory::officialAccount($config);

        $app->user->block('openidxxxxx');
        // 或者多个用户
        $app->user->block(['openid1', 'openid2', 'openid3',]);
    }


    //统一下单
    public function pay()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        $result = $app->order->unify([
            'body'             => '腾讯充值中心-QQ会员充值',
            'out_trade_no'     => '20150806125346',
            'total_fee'        => 88,
            'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            'notify_url'       => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type'       => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid'           => 'oUpF8uMuAJO_M2pxb1Q9zNjWeS6o',
        ]);
    }


    //根据微信订单号退款
    public function refundByTransactionId()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        $result = $app->refund->byTransactionId('transaction-id-xxx', 'refund-no-xxx', 10000, 10000, [
            // 可在此处传入其他参数，详细参数见微信支付文档
            'refund_desc' => '商品已售完',
        ]);
    }


    //根据商户订单号退款
    public function refundByOutTradeNo()
    {
        $config = config('wechat.');
        $app    = Factory::payment($config);
        $result = $app->refund->byOutTradeNumber('out-trade-no-xxx', 'refund-no-xxx', 20000, 1000, [
            // 可在此处传入其他参数，详细参数见微信支付文档
            'refund_desc' => '退运费',
        ]);
    }


    //发送普通红包
    public function redPacket()
    {
        $config      = config('wechat.');
        $app         = Factory::payment($config);
        $redpack     = $app->redpack;
        $redpackData = [
            'mch_billno'   => 'xy123456',
            'send_name'    => '测试红包',
            're_openid'    => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'    => 1,  //固定为1，可不传
            'total_amount' => 100,  //单位为分，不小于100
            'wishing'      => '祝福语',
            'client_ip'    => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name'     => '测试活动',
            'remark'       => '测试备注',
            // ...
        ];

        $result = $redpack->sendNormal($redpackData);
    }
}