<?php

	$data= array(
		'title'=>"我是soctk提交的title",
		'content'=>'我是octk提交的content'
	);

	$postData =http_build_query($data);
	$length = strlen($postData);


	//5 ->连接超时5秒就会断开
	$ch = fsockopen('localhost',80,$errno,$error,5);
	if(!$ch){
		echo "{$error}({$errno})<br />";
	}

	$request = "POST http://localhost/db.php HTTP/1.10\r\n";
	$request.= "Host:localhost\r\n";
	$request.= "Content-type:application/x-www-form-urlencoded\r\n";
	$request.= "content-length:{$length}\r\n\r\n";
	$request.=$postData;

	fwrite($ch, $request);

	while(!feof($ch)){
		echo  fgets($ch,1024);
	}

	fclose($ch);
