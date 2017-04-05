<?php

	$link = new mysqli();
	$link->connect('localhost','root','root','demo');
	if(!$link){
		die("连接失败:".$link->connect_error);
	}
	$link->set_charset('utf8') ;

