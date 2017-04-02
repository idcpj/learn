<?php

	//$title= filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING);
	//$content= filter_input(INPUT_POST, 'content',FILTER_SANITIZE_STRING);
	//try{
	//	$link = mysqli_connect('localhost','root','root');
	//	if(mysqli_connect_errno()){
	//		throw new Exception("数据库连接失败");
	//	}
	//	mysqli_select_db($link, 'test');
	//	$sql= "insert get_post(`title`,`content`) values('{$title}','$content')";
	//	$result= mysqli_query($link, $sql);
	//}catch(Exception $e){
	//	echo  "错误信息:".$e->getMessage();
	//}
	//

	$data =array(
		'title'=>'asfasf',
		'content'=> 'content',
	);

	$dataStr = http_build_query($data);
	$options = array(
		'http'=>array(
			'method'=>'POST',
			'header'=>"Host:localhost\r\n".
				"Content-type:application/x-www-form-urlencoded\r\n".
						'content-length:'.strlen($dataStr)."\r\n",
			'content'=>$dataStr
		)
	);

	$conten = stream_context_create($options);

	$url="http://localhost/db.php";
	file_get_contents($url,false,$conten);
	$handle = fopen($url, 'r',false,$conten);
	fclose($handle);
