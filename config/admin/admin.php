<?php
/**
 * 后台配置
 * @author yupoxiong<i@yufuping.com>
 * @date 2019/3/5
 */

return [
    //后台名称
    'name'             => '后台管理系统',
    //后台名称简称
    'short_name'       => '后台',
    //后台作者
    'author'           => 'XX科技',
    //后台版本
    'version'          => '0.1',
    //超级管理员默认密码警告
    'password_warning' => true,
    //首页欢迎信息
    'welcome_info'     => true,

    //登录配置
    'login'            => [
        //开启token验证
        'token'      => true,
        //验证码选项：false/0不开启验证码，1ThinkPHP图形验证码，2极验点击滑动验证码
        'captcha'    => 1,
        //登录背景，false为不需要背景，填写背景地址则为显示
        'background' => '/static/admin/images/background.jpg',

    ]
];