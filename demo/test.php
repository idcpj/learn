<?php
	function myfun($a,$b){
		echo $a+$b;
	}

	call_user_func_array('myfun', array(1,2));