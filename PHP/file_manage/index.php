<?php
require_once 'dir.func.php';
require_once 'file.func.php';
require_once 'common.func.php';
header("Content-type:text/html;charset=utf-8");
$path="file";
$path=$_REQUEST['path']?$_REQUEST['path']:'file';
$arr=readDirectory($path);
$redirect="index.php";
$act=$_REQUEST['act'];
$filename=$_REQUEST['filename'];

if($act=="创建文件"){
    //创建文件
    $filename=$_POST['filename_1'];
    $mes=creatFile($path."/".$filename);
    alertMes($mes,$redirect);
}elseif($act=="创建文件夹"){
    //创建文件夹
    $filename=$_POST['filename_2'];
    $mes=creatFolder($path."/".$filename);
    alertMes($mes, $redirect);

}elseif ($act=="showContent"){
    //参看文件内容
    $content=file_get_contents($filename);
    if (strlen($content)){
        //高亮显示php代码
        $newstr=highlight_string($content,true);
        $str=<<<E
            <table width="80%" bgcolor="#f0f0f0" cellPadding="10" cellSpacing="0">
                <tr>
                     <td>{$newstr}</td>
                </tr>
            </table>
E;
          echo $str;
    }else {
        alertMes("文件没有内容,请先编辑", $redirect);
    }
}elseif ($act=="editContent"){
    //编辑文件
       $content=file_get_contents($filename);
       $str=<<<EOF
       <form action="index.php?act=doEidt" method="post">
            <textarea name="content" id="" cols="190" rows="10">{$content}</textarea>
           <input type="hidden" name="filename" value="{$filename}" />
            <br />
            <input type="submit" value="提交修改内容"/>
       </form>
EOF;
       echo $str;
}elseif($act=="doEidt"){
    //提交修改后的内容
    $data=$_REQUEST['content'];
    if (file_put_contents($filename, $data)){
        $mes="文件修改成功";
    }else {
        $mes="文件修改失败";
    }
    alertMes($mes, $redirect);

}elseif ($act=="renameFile"){
    //显示重命名表单
    $edit_name=basename($filename);
    $str=<<<EOF
    <form action="index.php?act=doRenameFile" method="post">
                    新文件名:<input type="text" name="newname" value="" placeholder="{$edit_name}"/><br />
                <input type="hidden" name="oldname" value="{$filename}" /><br />
                <input type="submit"  value="更改重名名"/>
    </form>
EOF;
    echo $str;
}elseif ($act=="doRenameFile"){
    //重命名
    $mes=dorename($path);
    alertMes($mes, "index.php");
}elseif($act=="delFile"){
    //删除文件
    if (unlink($filename)){
        $mes="删除成功";
    }else{
        $mes="删除失败";
    }
    alertMes($mes, "index.php");
}elseif ($act=="downFile"){
    //下载文件
    downFile($filename);
}elseif($act=='copyFile'){
    //复制文件
    $str=<<<EOF
    <form action="index.php?act=doCopyFile" method="post">
                    将文件夹复制到:   <input type="text" name="dstname" value="" placeholder="复制地址"/>
                         <input type="hidden" name="dirname" value="{$filename}" />
                         <input type="hidden" name="path" value="{$path}" />
                        <input type="submit"  value="复制文件夹"/>
    </form>
EOF;
    echo $str;
}elseif ($act=="doCopyFile"){
    //复制文件夹
    /* file/1.html  ->  file/abc/1.html */
    $dstname=$_REQUEST['dstname'];
    $dirname=$_REQUEST['dirname'];
    var_dump($_REQUEST);
    $mes=copyFolder($dirname,$path."/".$dstname."/".basename($dirname));
//     alertMes($mes, "index.php?".$dirname);
}elseif ($act=='cutFile'){
    //显示剪切文件菜单
    $str=<<<EOF
    <form action="index.php?act=doCutFolder" method="post">
                    将文件剪切到:   <input type="text" name="dstname" value="" placeholder="剪切地址"/>
                         <input type="hidden" name="dirname" value="{$filename}" />
                         <input type="hidden" name="path" value="{$path}" />
                        <input type="submit"  value="确定"/>
    </form>
EOF;
    echo $str;
}elseif ($act=='doCutFolder'){

    //执行剪切
    $dstname=$_POST['dstname'];
    $dirname=$_POST['dirname'];
    $mes=cutFolder($dirname,$path.'/'.$dstname);
    alertMes($mes, $redirect);
}elseif ($act=="delFolder"){
    //删除文件
    //dirname=file/42&path=file
    $dirname=$_REQUEST['dirname'];
    $mes=delFolder($dirname);
    alertMes($mes, $redirect);
}elseif($act=="上传文件"){
    //上传文件
    $fileInfo=$_FILES['myFile'];
//     print_r($fileInfo);
    $mes=upLoadFile($fileInfo,$path);
    alertMes($mes, $redirect);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Insert title here</title>
<link rel="stylesheet" href="cikonss.css" />
<script src="jquery-ui/js/jquery-1.10.2.js"></script>
<script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<link rel="stylesheet" href="jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css"  type="text/css"/>
<style type="text/css">
	body,p,div,ul,ol,table,dl,dd,dt{
		margin:0;
		padding: 0;
	}
	a{
		text-decoration: none;
	}
	ul,li{
		list-style: none;
		float: left;
	}
	#top{
		width:100%;
		height:48px;
		margin:0 auto;
		background: #E2E2E2;
	}
	#navi a{
		display: block;
		width:48px;
		height: 48px;
	}
	#main{
		margin:0 auto;
		border:2px solid #ABCDEF;
	}
	.small{
		width:25px;
		height:25px;
		border:0;
}
</style>
<script type="text/javascript">
    function show(dis){
 	   document.getElementById(dis).style.display="block";
	}
	function delFile(filename,path){
		if(window.confirm("您确定要删除嘛?删除之后无法恢复哟!!!")){
				location.href="index.php?act=delFile&filename="+filename+"&path="+path;
		}
	}
	function delFolder(dirname,path){
		if(window.confirm("您确定要删除文件夹嘛?删除之后无法恢复哟!!!")){
			location.href="index.php?act=delFolder&dirname="+dirname+"&path="+path;
		}
	}
	function showDetail(t,filename){
		$("#showImg").attr("src",filename);
		$("#showDetail").dialog({
			  height:"auto",
		      width: "auto",
		      position: {my: "center", at: "center",  collision:"fit"},
		      modal:false,//是否模式对话框
		      draggable:true,//是否允许拖拽
		      resizable:true,//是否允许拖动
		      title:t,//对话框标题
		      show:"slide",
		      hide:"explode"
		});
		}
	function goBack(back){
		location.href="index.php?path="+back;
	}
</script>
</head>

<body>
<div id="showDetail"  style="display:none"><img src="" id="showImg" alt=""/></div>
<h1>慕课网-在线文件管理器</h1>
<!-- 顶部导航栏 -->
<div id="top">
	<ul id="navi">
		<li><a href="index.php" title="主目录"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-home"></span></span></a></li>
		<li><a href="#"  onclick="show('createFile')" title="新建文件" ><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-file"></span></span></a></li>
		<li><a href="#"  onclick="show('createFolder')" title="新建文件夹"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-folder"></span></span></a></li>
		<li><a href="#" onclick="show('uploadFile')"title="上传文件"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-upload"></span></span></a></li>
		<?php
		$black=($path=="file")?"file":dirname($path);
		?>
        <li><a href="#" title="返回上级目录" onclick="goBack('<?php echo $black?>')"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-arrowLeft"></span></span></a></li>
	</ul>
</div>
<!-- 隐藏div -->
<form action="index.php" method="post" enctype="multipart/form-data">
<table width="100%" border="1" cellpadding="5" cellspacing="0" bgcolor="#ABCDEF" align="center">
	<tr id="createFile"  style="display:none;">
		<td>请输入文件名称</td>
		<td >
				<input type="text"  name='filename_1' value="" />
				<input type="hidden" name="path" value='<?php echo $path;?>'/>
				<input type="submit"  name="act" value="创建文件" />
		</td>
	</tr>
    <tr id="createFolder"  style="display:none;">
		<td>请输入文件夹名称</td>
		<td >
			<input type="text" name="filename_2" />
			<input type="hidden" name="path"  value='<?php echo $path;?>'/>
			<input type="submit" name="act" value="创建文件夹"/>
		</td>
    </tr>
	<tr id="uploadFile" style="display:none;">
		<td >请选择要上传的文件</td>
		<td ><input type="file" name="myFile" />
			<input type="submit" name="act" value="上传文件" />
		</td>
	</tr>
	<tr>
		<td>编号</td>
		<td>名称</td>
		<td>类型</td>
		<td>大小</td>
		<td>可读</td>
		<td>可写</td>
		<td>可执行</td>
		<td>创建时间</td>
		<td>修改时间</td>
		<td>访问时间</td>
		<td>操作</td>
	</tr>

	<!-- 读文件 -->
	<?php
	$i=1;
    if(@$arr['file']){
        foreach ($arr['file'] as $val):
        $p=$path."/".$val;
    ?>
	<tr>
	   <td><?php echo $i;?></td>
	   <td><?php echo $val?></td>
	   <td><?php $src=filetype($p)=="file"?"file_ico.png":"folder_ico.png"?><img src="images/<?php echo $src?>" alt="" title="文件"/></td>
	   <td><?php echo transByte(filesize($p))?></td>
	   <td><?php $src=is_readable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可读"/></td>
	   <td><?php $src=is_writeable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可写"/></td>
       <td><?php $src=is_executable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可执行"/></td>
       <td><?php $time=filectime($p);echo date("Y-m-d H:i:s",$time);?></td>
       <td><?php $time=filemtime($p);echo date("Y-m-d",$time);?></td>
       <td><?php $time=fileatime($p);echo date("Y-m-d",$time);?></td>
       <td>
       <?php
       //得到文件扩展名
//         $ext=explode(".", $val);
//         $ext=end();
        $ext=getExt($val);
        $imageExt=array("gif","jpg","jpeg","png");
        if(in_array($ext, $imageExt)){
            ?>
            <a href="#" onclick="showDetail('<?php echo $val;?>','<?php echo $p;?>')" ><img class="small" src="images/show.png"  alt="" title="查看"/></a>|
       <?php
        }else {
       ?>
            <a href="index.php?act=showContent&path=<?php echo $path;?>&filename=<?php echo $p;?>" ><img class="small" src="images/show.png"  alt="" title="查看"/></a>|
        <?php }?>
    		<a href="index.php?act=editContent&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/edit.png"  alt="" title="修改"/></a>|
    		<a href="index.php?act=renameFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/rename.png"  alt="" title="重命名"/></a>|
    		<a href="index.php?act=copyFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/copy.png"  alt="" title="复制"/></a>|
    		<a href="index.php?act=cutFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/cut.png"  alt="" title="剪切"/></a>|
    		<a href="#"  onclick="delFile('<?php echo $p;?>','<?php echo $path;?>')"><img class="small" src="images/delete.png"  alt="" title="删除"/></a>|
    		<a href="index.php?act=downFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small"  src="images/download.png"  alt="" title="下载"/></a>
    	</td>
	</tr>
    <?php

    $i++;
    endforeach;
    }
    ?>
    <!-- 读文件结束 -->
    <!-- 读目录 -->
	<?php
    if(@$arr['dir']):
        foreach ($arr['dir'] as $val):
        $p=$path."/".$val;
    ?>
	<tr>
	   <td><?php echo $i;?></td>
	   <td><?php echo $val?></td>
	   <td><?php $src=filetype($p)=="file"?"file_ico.png":"folder_ico.png"?><img src="images/<?php echo $src?>" alt="" title="文件"/></td>
	   <td><?php echo transByte(dirSize($p)) ;?></td>
	   <td><?php $src=is_readable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可读"/></td>
	   <td><?php $src=is_writeable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可写"/></td>
       <td><?php $src=is_executable($p)=="true"?"correct.png":"error.png"?><img class="small" src="images/<?php echo  $src?>" alt="" title="可执行"/></td>
       <td><?php $time=filectime($p);echo date("Y-m-d H:i:s",$time);?></td>
       <td><?php $time=filemtime($p);echo date("Y-m-d",$time);?></td>
       <td><?php $time=fileatime($p);echo date("Y-m-d",$time);?></td>
       <td>
            <a href="index.php?path=<?php echo $p;?>" ><img class="small" src="images/show.png"  alt="" title="查看"/></a>|
    		<a href="index.php?act=renameFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/rename.png"  alt="" title="重命名"/></a>|
    		<a href="index.php?act=copyFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/copy.png"  alt="" title="复制"/></a>|
    		<a href="index.php?act=cutFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small" src="images/cut.png"  alt="" title="剪切"/></a>|
    		<a href="#"  onclick="delFolder('<?php echo $p;?>','<?php echo $path;?>')"><img class="small" src="images/delete.png"  alt="" title="删除"/></a>|
    		<a href="index.php?act=downFile&path=<?php echo $path;?>&filename=<?php echo $p;?>"><img class="small"  src="images/download.png"  alt="" title="下载"/></a>
    	</td>
	</tr>
    <?php
    $i++;
    endforeach;
    endif;
    if($i===1){
        $path=dirname($path);
        alertMes("没有内容", "index.php?path={$path}");
    }
    ?>
    <!-- 读目录结束 -->

</table>
</form>

</body>
</html>
