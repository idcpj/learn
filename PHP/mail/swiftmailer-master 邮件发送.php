<?php

/*
邮箱插件地址:https://github.com/swiftmailer/swiftmailer
*/



//发邮件的核心文件
require_once 'swiftmailer-master/lib/swift_required.php';

//配置服务器
$transport=Swift_SmtpTransport::newInstance('smtp.163.com',25);
//设置账号密码
$transport->setUsername("15726817105@163.com");
$transport->setPassword("a13757547812");
//得到发邮件对象
$email=Swift_Mailer::newInstance($transport);


//得到邮件对象
$message=Swift_Message::newInstance();
//设置管理员帐号名字
$message->setFrom(array("15726817105@163.com"=>"cpj_163"));
//发送给某人
$message->setTo(array("260083304@qq.com"=>"我的网易帐号"));
//邮件主题
$message->setSubject("我的测试邮件");
$str=<<<EOF
	这是一份邮件,用来测试我会不会发邮件.
EOF;
$message->setBody($str,"text/html","utf-8");


if($email->send($message)){
	echo "发送成功<br />";
	echo "3秒后跳转页面";
	echo "<meta http-equiv='refresh' content='3;url=http://www.imooc.com' />";
}else{
	echo "邮件注册失败";		
}

