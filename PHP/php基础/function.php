<?php
	/*
	 * 函数分为值传递和引用传递
	 * 1.引用传递.会改变参数的值
	 * 函数内部给参数的赋值会改变原来参数
	 * */
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

/*======================*/

	//函数引用外部外部变量需要用global
	$a_name="hello word";
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






