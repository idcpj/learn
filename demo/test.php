<?php
	class Memcache{
		public function set($var, $val){
			//code
		}

		public function get($var){
			//code
		}

	}

	class Redis{
		public function set($var, $val){
			//code
		}

		public function get($var){
			//code
		}
	}


	class Cache{
		public static function factory(){
			return new Memcache();
		}
	}

	//无需关心是实例化了什么缓存类型,下次想日环为radis 直接修改factory为 new Radis
	$obj = Cache::factory();
