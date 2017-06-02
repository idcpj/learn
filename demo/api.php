
<?php
	/*
	//md5签名方式--非简单签名
	header("Content-Type:text/html;charset=UTF-8");
	date_default_timezone_set("PRC");
	$showapi_appid = '35069';  //替换此值,在官网的"我的应用"中找到相关值
	$showapi_secret = '67fa225369e14c55ba0447a89ff92244';  //替换此值,在官网的"我的应用"中找到相关值
	echo $page =empty($_POST['page|'])? filter_input(INPUT_POST, 'page',FILTER_VALIDATE_INT):1;
	echo filter_input(INPUT_POST, 'page',FILTER_VALIDATE_INT);
	//echo  $page=isset($_POST['page'])?$_POST['page']:2;
	$paramArr = array(
		'showapi_appid'=> $showapi_appid,
		'page'=> $page,
		'maxResult'=> "1"
		//添加其他参数
	);

	//创建参数(包括签名的处理)
	function createParam ($paramArr,$showapi_secret) {
		$paraStr = "";
		$signStr = "";
		ksort($paramArr);
		foreach ($paramArr as $key => $val) {
			if ($key != '' && $val != '') {
				$signStr .= $key.$val;
				$paraStr .= $key.'='.urlencode($val).'&';
			}
		}
		$signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
		$sign = strtolower(md5($signStr));
		$paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
		echo "排好序的参数:".$signStr."<br>\r\n";
		return $paraStr;
	}

	$param = createParam($paramArr,$showapi_secret);
	$url = 'http://route.showapi.com/341-3?'.$param;
	//echo "请求的url:".$url."<br>\r\n";
	$result = file_get_contents($url);
	//echo "返回的json数据:<br>\r\n";
	//print_r($result.'<br>\r\n');
	$result = json_decode($result,true);
	//echo "<br>\r\n取出showapi_res_code的值:<br>\r\n";
	//print_r($result->showapi_res_code);
	//echo "<br>\r\n";
	$contentlsit = $result['showapi_res_body']['contentlist'];
	$contentStr ="";
	foreach($contentlsit as $key=>$content){
		$contentStr .= "<h1>{$content['title']}</h1>";
		$contentStr .= "<img src='{$content['img']}'>";
		$contentStr .= "<p>{$content['ct']}</p>";

	}
	echo $contentStr;

	$pageAll=$result['showapi_res_body']['allPages'];
	$currentPage=$result['showapi_res_body']['currentPage'];
	$allNum=$result['showapi_res_body']['allNum'];

?>

    //<!--<form action="" method="post">-->
    //<!--    <input type="range" name="page" value="--><?php //echo $currentPage ;?><!--" max="--><?php //echo $allNum?><!--">-->
   <!--    <input type="submit" value="跳转">-->
    <!--</form>-->
*/
	class Joke {

		private $showapi = '35069';  //替换此值,在官网的"我的应用"中找到相关值
		private $showapi_secret = '67fa225369e14c55ba0447a89ff92244';  //替换此值,在官网的"我的应用"中找到相关值

		public function __construct()
		{
			$paramArr = array(
				"showapi_appid"=>$this->showapi,
				"showapi_secret"=>$this->showapi_secret,
			);


		}


		//private function createParam($paramArr,$showapi_secret) {
		//	$paraStr = "";
		//	$signStr = "";
		//	ksort($paramArr);
		//	foreach ($paramArr as $key => $val) {
		//		if ($key != '' && $val != '') {
		//			$signStr .= $key.$val;
		//			$paraStr .= $key.'='.urlencode($val).'&';
		//		}
		//	}
		//	$signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
		//	$sign = strtolower(md5($signStr));
		//	$paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
		//	echo "排好序的参数:".$signStr."<br>\r\n";
		//	return $paraStr;
		//}
	}

	$joke = new Joke();
	print_r($joke->paramArr());

