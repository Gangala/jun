<?php

//获取对象中的错误信息
function get_error(\Think\Model $model) {
    $errors = $model->getError();
    if (!is_array($errors)) {
        $errors = [$errors];
    }
    $html = '<ol>';
    foreach ($errors as $error) {
        $html .= '<li>' . $error . '</li>';
    }
    $html.='</ol>';
    return $html;
}

function SendEmail($address,$title,$content)
{
    vendor('PHPMailer.PHPMailerAutoload');
    $mail = new \PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.126.com';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'telecomadmin@126.com';                 // SMTP username
    $mail->Password = 'telecomadmin61';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('telecomadmin@126.com');
    $mail->addAddress($address);                          // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $title;
    $mail->Body = $content;

    $mail->CharSet = 'UTF-8';

    //判断邮件发送状态
    if(!$mail->send()){
        $data = [
            'status' => false,
            'msg' =>$mail ->ErrorInfo,
        ];
    }else{
        $data = [
            'status' => true,
            'msg' =>'发送成功',

        ];
        return $data;
    }
}