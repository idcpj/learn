<?php
	$small = range('a', 'z');
	$big = range('A', 'Z');
	$num = range('0', '9');
	$cop = array_merge($small, $big,$num);
	//print_r(explode(',', '1,2,3,4'));


	echo iconv('UTF-8', 'GB2312', '创建');