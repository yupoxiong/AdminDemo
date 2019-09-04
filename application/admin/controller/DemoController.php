<?php
/**
 * 常用功能集合
 */

namespace app\admin\controller;


use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Overtrue\EasySms\EasySms;
use PHPMailer\PHPMailer\PHPMailer;
use think\Request;

class DemoController extends Controller
{

    //邮件页面
    public function email()
    {
        return $this->fetch();
    }


    //发送邮件功能
    public function sendEmail(Request $request)
    {
        $param = $request->param();

        $config = config('email.smtp');
        $mail   = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {

            $address      = $param['address'];
            $subject      = $param['subject'];
            $content      = $param['content'];
            $full_content = $request->param(false)['content'];

            //服务器配置
            $mail->CharSet   = "UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host       = $config['host'];                // SMTP服务器
            $mail->SMTPAuth   = true;                      // 允许 SMTP 认证
            $mail->Username   = $config['username'];                // SMTP 用户名  即邮箱的用户名
            $mail->Password   = $config['password'];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port       = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom($config['address'], $config['name']);  //发件人
            $mail->addAddress($address, $address);  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo($config['address'], $config['name']); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            //$mail->addAttachment(app()->getRootPath() . 'public/uploads/attachment/20190902/6a673f554c694a41971fca94c7503315.jpg', 'test.jpg');    // 发送附件并且重命名

            //Content
            $mail->isHTML(true);  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $subject;
            $mail->Body    = $full_content;
            $mail->AltBody = $content;

            $mail->send();
            $result = true;
            $msg    = '邮件发送成功';
        } catch (\Exception $e) {
            $msg    = '邮件发送失败,错误信息:' . $mail->ErrorInfo;
            $result = false;
        }

        return $result ? success('成功', URL_RELOAD, '') : error($msg);
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
    public function createQrCode(Request $request)
    {
        $param = $request->param();

        $content = $param['content'] ?? '麻烦输入内容OK？';

        //创建码，$content为二维码内容
        $qrCode = new QrCode($content);
        //设置尺寸
        $qrCode->setSize(300);
        //可以设置binary,png,svg,eps,debug
        $qrCode->setWriterByName('png');
        //设置边距
        $qrCode->setMargin(10);
        //编码
        $qrCode->setEncoding('UTF-8');
        //容错等级
        $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));
        //前景色
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        //背景色
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        //标签
        $qrCode->setLabel('Admin Demo QrCode', 16, null, LabelAlignment::CENTER);
        //logo地址


        $qrCode->setLogoPath(app()->getRootPath() . 'public/uploads/attachment/20190902/6a673f554c694a41971fca94c7503315.jpg');
        //logo大小
        $qrCode->setLogoSize(100, 100);
        //块尺寸设置为整数，默认为true
        $qrCode->setRoundBlockSize(true);
        //验证结果
        $qrCode->setValidateResult(false);
        //写入选项
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

        //直接输出图片
        //header('Content-Type: '.$qrCode->getContentType());
        //return $qrCode->writeString();

        $file_name = random_int(1, 5);
        //保存成文件
        $qrCode->writeFile(app()->getRootPath() . 'public/demo/qrcode/' . $file_name . '.png');
        $code_url = '/demo/qrcode/' . $file_name . '.png';

        return success('生成成功', URL_CURRENT, ['qrcode' => $code_url]);


        // Create a response object


    }
}