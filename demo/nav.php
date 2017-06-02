<?php
	/**
	 *
	 * 面包屑导航
	 *  新闻/国内新闻/北京新闻
	 *
	 * 原理输入子类id,查找到父id,并作为子类id
	 */


	include_once 'db.php';



	function showNav($id,$link,&$navStr=''){
		$sql="select * from deepcate WHERE id={$id}";
		$res = $link->query($sql);
		$row=$res->fetch_assoc();
		if(empty($navStr)){
			/*<span>$navStr<span>*/
			$navStr ="<span>".$row['catename']."<span>";
		}else{
			$navStr ="<span>".$row['catename']."<span>".'/'.$navStr;
		}
		if($row['pid']){
			showNav($row['pid'], $link,$navStr);
		}

		return $navStr;
	}

	echo showNav(9, $link);



