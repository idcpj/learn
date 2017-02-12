<?php
/**
 * 读所有文件目录
 * @param string $path
 * @return array
 */
function readDirectory($path){
    //打开目录
    $handle=opendir($path);
    while (($item=readdir($handle))!==false){
        //.和..这两个特殊目录要删除
        if($item!="."&&$item!=".."){
            //判断是文件
            if(is_file($path."/".$item)){
                $arr['file'][]=$item;
            }
            //判断是文件夹
            if(is_dir($path."/".$item)){
                $arr['dir'][]=$item;
            }
        }
    }
    closedir($handle);
    return @$arr;
}

function dirSize($path){
    $num=0;  //static只是初始化一次
    $handle=opendir($path);
    while (($item=readdir($handle))!==false){
        if($item!="."&&$item!=".."){
            if(is_file($path."/".$item)){
                $num+=filesize($path."/".$item);
            }
            if(is_dir($path."/".$item)){
                $func=__FUNCTION__;
                $num+=$func($path."/".$item);
            }
        }
    }
    closedir($handle);
    return $num;
}

/**复制文件夹
 * @param string $src   原地址
 * @param string $dst   复制地址
 * @return string
 */
function copyFolder($src,$dst){
    //创造文件
//     echo $src."---".$dst."---".$dstname; //file/4.jpg     file/42/4.jpg
//     exit;
    if(!file_exists($dst)){
        mkdir($dst,0777,true);
    }
    $handle=opendir($src);
        while (($item=readdir($handle))!==false) {
            if($item!="."&&$item!='..'){
                if(is_file($src.'/'.$item)){
                    copy($src.'/'.$item, $dst.'/'.$item);
                }
                if(is_dir($src.'/'.$item)){
                       /* 回调函数 */
                        $func=__FUNCTION__;
                        $func($src.'/'.$item,$dst.'/'.$item);
                }
            }
        }
        closedir($handle);
        return "复制成功";
}
/**创建文件夹
 * @param unknown $filename
 * @return string
 */
function creatFolder($filename){
    $pattern="/[\/,\*,<>,\?,\|]/";
    if(!is_file($filename)){
        mkdir($filename,0777,true);
        return "文件创建成功";
    }else {
        return "文件已存在";
    }
}
/**
 * 剪切文件夹
 * @param string $src
 * @param string $dst
 * @return string
 */
function cutFolder($src,$dst){
    /*
     * $src=file/2    $dst=file/42/2
     *  把一个文件移到另一个文件夹下
     *  file/2   ->  file/42/2
     *  */
       if(file_exists($dst)){
            if(is_dir($dst)){
                if(!file_exists($dst."/".basename($src))){
                    if(rename($src, $dst."/".basename($src))){
                        return basename($src)." 剪切成功";
                    }else {
                        return "文件剪切失败";
                    }
                }else{
                    return "目标目录下存在同名文件夹";
                }

            }else {
                return basename($src)." 不是一个文件夹";
            }
       }else {
           return basename($src)." 目标文件不存在";
       }
}
/**
 * 删除文件夹
 * @param string $path
 * @return string
 */
function delFolder($path){
    //path=file/42
    $handle=opendir($path);
    while (($item=readdir($handle))!==false) {
        if ($item!="." && $item!="..") {
            if(is_file($path."/".$item)){
                unlink($path."/".$item);
            }elseif(is_dir($path."/".$item)){
                $func=__FUNCTION__;
                $func($path."/".$item);
            }
        }
    }
    closedir($handle);
    rmdir($path);
    return "删除成功";
}






