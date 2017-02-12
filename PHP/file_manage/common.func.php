<?php
/**提示操作信息,并跳转
 * @param sting $mes
 * @param sting $url
 */
function alertMes($mes,$url){
	echo "<script type='text/javascript'>alert('{$mes}');location.href='{$url}';</script>";
}

/**得到文件扩展名
 * @param unknown $filename
 * @return string
 */
function getExt($filename){
    return strtolower(end(explode(".", $filename)));
}

function getUniqName($length=10){
    return substr(md5(uniqid(microtime(true),true)), 0,$length);
}
