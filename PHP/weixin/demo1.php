<?php
	//将从微信传过来来的token、timestamp、nonce三个参数进行字典序排序
	$timestamp=$_GET['timestamp'];
	$nonce = $_GET['nonce'];
	$token = $_GET['token'];
	$signature = $_GET['signature'];
	$array = array( $timestamp, $noce, $token,);
	//将三个参数字符串拼接成一个字符串进行sha1加密
	$tmpstr = implode('', $array);
	$tmpstr = sha1($tmpstr);
	//开发者获得加密后的字符串可与signature对比，标识该请求来源于微信

