<?php
session_start();

include_once( 'config.php' );

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );

//获取信息
$uid=$_SESSION['token']['uid'];
$arr=$c->show_user_by_id($uid);
$userame=$arr['name'];
$userImage=$arr['profile_image_url'];
$pic_path="images/".$uid.".jpg";

//制作图片
$res=doimage($userImage, $userame,$pic_path) or die("制作图片失败");


if(!empty($_GET['sub'])){
	/* 发图片微博  */
	$status=$_GET['con']."#家里蹲大学#";
	$res=$c->upload($status, $pic_path);
	if($res['error']){
		echo $res['error_code'].":".$res['error']."<br />"; 
	}else{
		echo "<script>alert('发送成功')</script>";
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>发表文章</title>
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.center{
			text-align:center;
		}
	</style>
</head>
<body>
	<img src="<?php echo $pic_path;?>" alt="" />
	<form action="" method="get">
		<h2>发表微博: </h2>
		<textarea name="con" id="" cols="150" rows="10" placeholder="我知道你不会写东西，但必须还得写点"></textarea><br />
		
		<input class=“btn-primary” type="submit" name="sub" value="发表微博"/>
	</form>

</body>
</body>
</html>