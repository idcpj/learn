<?php
	$i = 1;
	function loop(){
		global $i;
		echo $i;
		$i++;
		if($i<10){
			loop($i);
		}
	}
	loop();
