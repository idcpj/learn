<?php

	//抽象类原型
	Abstract class Prototype{
		abstract function __clone();
	}

	class Map extends Prototype{
		public $width;
		public $height;
		public $sea;

		public function __clone(){}
		public function setAttriBute(array $attributes){
			foreach($attributes as $key=>$v){
				$this->$key=$v;
			}
		}
	}

	class Sea{
		public function water(){
			echo  "bigest";
		}
	}

	//使用原型模式创建对象方法

	//先创建一个原型对象
	$mapC = new Map();
	$attributes =array(
		'width' =>40,
		'height' =>60,
		'sea' =>(new Sea()),
	);
	//如此便创建好一个原型对象, 需要新发map 只需要克隆
	$mapC->setAttriBute($attributes);

	$new_mapC= clone $mapC;
	var_dump($mapC);
	var_dump($new_mapC);


