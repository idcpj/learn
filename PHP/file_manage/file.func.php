<?php
/**转换文件大小
 * @param number $size
 * @return number
 */
//Bytes/kb/MB/GB/TB/EB
function  transByte($size){
    $arr=array("Byte","KB","GB","TB","EB");
    $i=0;
    if($size<1024){
        $size/=1024;
        return round($size,2)."  KB";
    }else{
        while ($size>1024){
            $size/=1024;
            $i++;
        }
    }
    return round($size,2)." ".$arr[$i];
}

/**创建文件
 * @param unknown $fileName
 * @return string
 */
function creatFile($fileName){
    //验证文件名的合法性,是否包含/ \ <> ? |
    $pattern="/[\/,\*,<>,\?,\|]/";
    if(!preg_match($pattern, basename($fileName))){
        //验证当前目录下是否存在同名文件名
        if(!file_exists($fileName)){
            //通过touch($filename)创建文件
            if (touch($fileName)){
                return basename($fileName)."  文件创建成功";
            }else{
                return basename($fileName)."  文件创建失败";
            }
        }else{
            return basename($fileName)."  文件已存在,请重命名后创建";
        }
    }else {
        return "非法文件名";
    }
}


/**
 * 重命名文件
 * @return string
 */
function dorename($path){
    //执行重命名
    $oldname=$_REQUEST['oldname'];
    $newname=$_REQUEST['newname'];
    //判断文件是否非法
    $pattern="/[\/,\*,<>,\?,\|]/";
    if (!preg_match($pattern, $newname)){
        /* 判断文件名是否存在 */
        if(!file_exists($path."/".$newname)){
            if (rename($oldname, $path."/".$newname)){
                $mes="修改成功";
            }else {
                $mes="修改失败";
            }
        }else {
            $mes="文件名存在";
        }
    }else {
        $mes="文件名非法";
    }
    return $mes;
}

/**下载文件
 * @param string $filename
 */
function downFile($filename){
    header("content-disposition:attachment;filename=".basename($filename));
    header("content-length:".filesize($filename));
    readfile($filename);
}

function upLoadFile($fileInfo,$path,$allowExt=array("gif","jpeg","jpg","png",'txt'),$maxSize=10485760){
    //判读错误号
    if($fileInfo['error']==UPLOAD_ERR_OK){
        if(is_uploaded_file($fileInfo['tmp_name'])){
            //上传文件的文件名
            $ext=getExt($fileInfo['name']);
            /* 生成唯一文件名 */
            $uniqid=getUniqName();
            $destination=$path.'/'.pathinfo($fileInfo['name'],PATHINFO_FILENAME).'_'.$uniqid.".".$ext;
//             var_dump(pathinfo($fileInfo['name'],PATHINFO_BASENAME));
//             exit();
            if(in_array($ext, $allowExt)){
                if($fileInfo['size']<=$maxSize){
                    if(move_uploaded_file($fileInfo['tmp_name'], $destination)){
                        return "上传成功";
                    }else {
                        return "文件上传失败";
                    }
                }else {
                    return '文件过大';
                }
            }else {
                return "非法文件名";
            }
        }else{
            return "不是通过HTTP POST 方式上传上来的";
        }
    }else {
        return $fileInfo['error']."上传失败";
    }
}
