<?php

	function dowlaod_file($file,$filename){
		ob_clean();
		$file = file_get_contents($file);
		//$file = fopen($file,"r");
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: ".strlen($file));
		header('Content-Disposition: attachment; filename='.$filename);
		header("Pragma:no-cache");
		header("Expires:0");
		echo $file;
		die;
	}

	$file='Zip.php';
	$filename=$file;
	dowlaod_file($file, $filename);