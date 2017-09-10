<?php
	/**
	 * 下载本地及网络资源文件
	 * @param $filename
	 * @param $outname
	 * @internal param $orderData
	 * @internal param $orderid
	 */
	function download($filename,$outname){
		ob_clean();
		//获取文件后缀
		if(empty($outname)){
			echo "文件名不能为空";
		}
		$file = file_get_contents($filename);
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: ".strlen($file));
		header('Content-Disposition: attachment; filename='.$outname);
		header("Pragma:no-cache");
		header("Expires:0");
		echo $file;
		die;

	}

	/**
	 * @param $dataArr      要打包的数据
	 * @param $fileName     创建要压缩的文件名路径
	 * @param bool $type     为TRUE  生成后立即下啊
	 * @return string
	 */
	function create_zip($dataArr,$fileName,$type=true)
	{
		//图片数组
		if(!is_array($dataArr)) return "参数有误";

		//创建压缩包的路径
		if(empty($fileName)) return "请填写保存路径";

		$zip = new \ZipArchive;
		$zip->open($fileName, \ZipArchive::OVERWRITE);
		//往压缩包内添加目录
		foreach($dataArr as $key => $value){
			$fileData = file_get_contents($value);
			if($fileData){
				//zip中文件路径
				$zipDir='';
				$zip->addFromString($zipDir. basename($value), $fileData);
			}
		}
		$zip->close();
		//下载文件
		if($type){
			download_file($fileName);
		}
	}

	/**
	 * @param $url
	 * @return mixed
	 */
	function sendcurl($url){
		//初始化curl
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//运行curl，结果以jason形式返回
		$res = curl_exec($ch);
		curl_close($ch);
		//取出openid
		$data = json_decode($res, true);

		return $data;
	}



