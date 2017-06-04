<?php
	header('Content-type:text/html;charset:utf-8');
	//大括号和中括号等价

	//输出字符串
	$str ="abcde";
	echo $str{0};//a

	//替换
	$str{1}='m';
	echo $str;//amcde

	//追加
	$str[5]='f';
	echo $str;//abcdef

	//输出中文
	$strc="你好";
	echo $strc{0};
	echo $strc{1};
	echo $strc{2};//输出你
	echo  strlen($strc);

	//随机字符串
	echo $str{mt_rand(0,strlen($str)-1)};

	//获取字符串类型
	echo gettype($str);//string

	//永久转换
	$var = 123;
	settype($var, 'string');
	var_dump($var);//string->3

	//字符串转数字
	echo 3+'2cpj';//5
	echo 3+'2e2';//203  科学计数法



