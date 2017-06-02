<?php
	function down_oad()
	{
		//图片数组
		$res = array(
			'/data/upload/App/20170523/5923a57c65e84.jpg',
			'/data/upload/App/20170523/5923a57c66b74.jpg',
		);
		//创建压缩包的路径
		$filename = $_SERVER['DOCUMENT_ROOT'] . '/data/Download/' . time() . '.zip';
		$zip = new \ZipArchive;
		$zip->open($filename, \ZipArchive::OVERWRITE);
		//往压缩包内添加目录
		//$zip->addEmptyDir('images');
		foreach($res as $key => $value){
			$fileData = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $value);
			if($fileData){
				//左边设置文件路径,右边参数设置文件资源
				$add = $zip->addFromString('images/' . $key . '.jpg', $fileData);
			}
		}
		$zip->close();
		//下载文件
		ob_end_clean();
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename=' . time() . '.zip');
		header('Content-Length: ' . filesize($filename));
		error_reporting(0);
		readfile($filename);
		flush();
		ob_flush();

	}


