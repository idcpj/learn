<?php

	//<editor-fold desc="引用传递.会改变参数的值">
	function swap(&$a, &$b){
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	$a = 3;
	$b = 4;
	swap($a, $b);
	echo $a;//4
	echo $b;//3
	//</editor-fold>

	//<editor-fold desc="函数引用外部外部变量需要用global">
	$a_name = "hello word";
	//方法一
	function show(){
		global $a_name;
		echo $a_name;
	}
	show(); //hello word

	//方法二
	function show1(){
		echo $GLOBALS['a_name'];
	}
	show1();//hello word
	//</editor-fold>

	//<editor-fold desc="静态变量">
	function foo(){
		static $a = 0;    //静态声明,赋值必须在一行
		echo $a++;
	}

	foo();//0
	foo();//1
	foo();//2
	//</editor-fold>

	//<editor-fold desc="可变函数">
	function get_apple($num){
		echo 'give I apple I need '.$num;
	}
	function get_banna($num){
		echo 'give I banna I need '.$num;
	}
	function get_fruit($name,$num){
		$opt = 'get_'.$name;
		return $opt($num);
	}
	get_fruit('apple',5);//give I apple I need 5
	//</editor-fold>

	//<editor-fold desc="嵌套函数-当外部函数被调用时,内部函数就会自动进入全局域,成为新的函数">
	function out(){
		function int(){
			echo '当外部函数没有被调用时候,我并不存在';
		}
	}
	out();
	int();
	//</editor-fold>

	//<editor-fold desc="闭包">
	$foo = function(){
		echo "hello word";
	};      //记得加分号

	$foo();
	//</editor-fold>

	//<editor-fold desc="加载单个文件">
	set_include_path('src');//设置路径
	require_once ('test1.php');//设置文件名
	require_once ('test2.php');
	require_once ('test3.php');
	test2();
	test3();
	//</editor-fold>

	//<editor-fold desc="加载多个文件">
	set_include_path(get_include_path().PATH_SEPARATOR.'dir1');
	//get_include_path() 获取已加载路径,
	//PATH_SEPARATOR  linux上是一个":"号,WIN上是一个";"号
	set_include_path(get_include_path().PATH_SEPARATOR.'dir2');
	require_once ('test1.php');//设置文件名
	require_once ('test2.php');
	require_once ('test3.php');
	require_once ('test4.php');
	test3();
	test4();
	//</editor-fold>
