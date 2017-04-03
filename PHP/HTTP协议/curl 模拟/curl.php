<?php

	//初始化curl会话
	$ch = curl_init();

	$url = 'http://localhost/test.php';
	$data= array(
		'title'=>"我是curl提交的title",
		'content'=>'我是curl提交的content'
	);

	//设置提交的url
	curl_setopt($ch, CURLOPT_URL, $url);

	//设置提交方式
	curl_setopt($ch, CURLOPT_POST, 1);

	//设置数据
	curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

	//提交成功,返回为字符串
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//执行
	$result= curl_exec($ch);

	//关闭
	curl_close($ch);


	echo $result;
