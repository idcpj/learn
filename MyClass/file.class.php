<?php

	/**
	 * 文件操作
	 * Class ReadDir
	 */
	class file{
		private $path ='';

		public function __construct($dir){
			$this->path=isset($_GET['path'])? $_GET['path']:$dir;
		}

		/**
		 * 文件展示,点击跳转
		 */
		public function listDir(){
				if($handle = opendir($this->path)){
					while(($file =readdir($handle)) !==false){
						if($file !='.' && $file != '..'){
							//$file为目录
							$changePath =$this->path.'/'.$file;
							if(is_dir($changePath)){
								//<a href = 'test.php?path=changepath'>$file<a /><br />
								echo "<a href='./file.class.php?path={$changePath}' style='color: cornflowerblue'>$file<a /><br/ >";
							}else{
								//$file 为文件
								echo $file."<br />";
							}
						}
					}
				}
			}
	}


	//$readDirC =new ReadDir('./');
	//$readDirC->listDir();


