#公共函数
##1.下载
```PHP
download_file('../test.zip','新名字.zip')
```
##2.压缩
```php
$res = array(
		'../demo/api.php',
		'../demo/db.php',
);
 create_zip($res,'data/upload/cc.zip');
```
#class