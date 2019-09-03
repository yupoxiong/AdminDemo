<?php
/**
 * 常用功能集合
 */

namespace app\admin\controller;


use Overtrue\EasySms\EasySms;
use think\Request;

class DemoController extends Controller
{


    //邮件页面
    public function email()
    {
        return $this->fetch();
    }


    //发送邮件功能
    public function sendEmail()
    {

    }

    //短信页面
    public function sms()
    {
        return $this->fetch();
    }

    //发送短信功能
    public function sendSms(Request $request)
    {
        $param   = $request->param();
        $config  = config('sms.');
        $easySms = new EasySms($config);

        try {
            $result  = $easySms->send($param['mobile'], [
                'template' => 'SMS_001',
                'data'     => [
                    'code' => 543260
                ],
            ]);
            $success = true;
            $msg     = '发送成功';
        } catch (\Exception $e) {
            $success = false;
            $msg     = $e->getMessage();
        }

        if (!$success || $result['aliyun']['status'] !== 'success') {
            return error($msg);
        }

        return success($msg);
    }


    //二维码页面
    public function qrCode()
    {



        return $this->fetch();
    }


    //生成二维码功能
    public function createQrCode()
    {

    }
}