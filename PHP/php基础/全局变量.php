<?php

	/**
	 * $_COOKIE
	 * */
	setcookie('test','testvvalue',time()+12);//设置后 把setcookie('test','testvvalue')注释;依然有值
	var_dump($_COOKIE['test']);//testvvalue
	setcookie('test','',time()-1); //用过去的时间,删除

	/**
	 * $_ENV
	 */
	$_ENV['test2']='test2';   //关闭浏览器值就消失
	var_dump($_ENV['test2']);
	unset($_ENV['test2']);//删除

	/**
	 * $_SESSION
	 */

	session_cache_expire(30);//设置缓存时间  单位:分钟  默认:180分钟
	session_start();
	$_SESSION['test']='test';
	var_dump($_SESSION['test']);


