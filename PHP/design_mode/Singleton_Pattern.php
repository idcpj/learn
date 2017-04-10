<?php

	/*
	 * //单例模式demo
class Singleton{
	private static $_instance = null;

	//只在创建的时候被调用一次
	private function __construct(){
		echo  "该例子已经被实例化了";
	}

	private function __clone()
	{
	}

	//需要时直接调用此方法
	public static function getInstance(){
		//判断是否实例化
		if(!(self::$_instance instanceof Singleton )){
			self::$_instance=new Singleton();
		}
		return self::$_instance;
	}

	public function test(){
		echo  "test hello word";
	}
}

	$SingletnObj = Singleton::getInstance();
	$SingletnObj->test();
*/


	class DB{
		private $link ;
		private static $_instance;
		private $dsn = "mysql:host=127.0.0.1;dbname=test";
		private $username = 'root';
		private $password = 'root';


		//连接数据库
		private function __construct(){
			try{
				$this->link = new PDO($this->dsn,$this->username,$this->password);
				$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e ){
				die("连接失败:".$e->getMessage());
			}

			return $this->link;
		}

		//防止被克隆
		private function __clone(){}

		//获取实例
		public static function getInstance(){
			if(!(self::$_instance instanceof self)){
				self::$_instance = new DB();
			}
			return self::$_instance;
		}

		//query
		public function query($sql){
			return $this->link->query($sql);
		}

		//获取一行
		public function fetchOne($sql){
			$result= $this->query($sql);
			return $result->fetch(PDO::FETCH_ASSOC);
		}

		//获取全部
		public function fetchAll($sql){
			$result = $this->query($sql);
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}
		//获取记录条数

		public function counts($sql){
			$result = $this->query($sql);
			return $result->rowCount();
		}
	}

	$link = DB::getInstance();
	$sql = "select * from `cmf_auth_rule` ";
	print_r($link->counts($sql));












