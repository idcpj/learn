<?php
	$title= filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING);
	$content= filter_input(INPUT_POST, 'content',FILTER_SANITIZE_STRING);

		$link = mysqli_connect('localhost','root','root');
		if(mysqli_connect_errno()){
			die("数据库连接失败".mysqli_connect_error());
		}
		mysqli_select_db($link, 'test');
		$sql= "insert get_post(`title`,`content`) values('{$title}','{$content}')";
		$result= mysqli_query($link, $sql);
		if($result =false){
		    die("插入失败:".mysqli_error($link));
        }
	
	
/*?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <div>
        <label for="title">标题</label>
        <input type="text" id="title" name="title">
    </div>
    <div>
        <label for="content">内容</label>
        <input type="text" id="content" name="content">
    </div>
    <input type="submit" value="提交">
</form>
</body>
</html>
*/
