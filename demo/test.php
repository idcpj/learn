<?php

$a="hello word";

function test(){
	static $i=1;
	echo '$i:'.$i;
	$i++;
}
