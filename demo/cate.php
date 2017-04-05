<?php
	/**
	 * 功能:
	 * 1.实现了option生成选项
	 *
	 */


	include_once './db.php';

	/**
	 * @param int   $pid  父类id
	 * @param array $rows 地址变量可存储上一次的变量
	 * @param int   $spac  空格
	 * @param       $link
	 * @return array
	 */
	function getList($pid = 0,$spac= 0, $link,&$rows=array())
	{
		$spac  =$spac+ 4;
		$sql = " SELECT * FROM `deepcate`  WHERE pid={$pid}";
		$res = $link->query($sql);
		//var_dump($res);
		while($row = $res->fetch_assoc()){
			$row['catename']=str_repeat("&nbsp",$spac) .'|--'.$row['catename'];
			$rows[] = $row;
			getList($row['id'], $spac, $link,$rows);
		}

		return $rows;

	}

	/**
	 * @param int $pid  父类id
	 * @param int $select  选中值
	 * @param     $link
	 * @return string
	 */
	function showSelect($pid =0,$select =1,$link){
		$rows = getList($pid, 0, $link);
		$res = '';
		$res .="<select name ='cate'>\n";
		$selectStr = '';
		foreach($rows as $key=>$val){
			if($val['id'] ==$select){
				$selectStr='selected';
			}else{
				$selectStr='';
			}
			$res.="<option {$selectStr} value='{$val['id']}'>{$val['catename']}</option>\n";
		}

		$res .="<select/>\n";
		return $res;
	}

	//echo (showSelect(0,3,$link));
