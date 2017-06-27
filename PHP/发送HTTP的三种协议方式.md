#说明
通过三种方式来模拟HTTP协议的发送

##1.curl
```php
//初始化curl会话
$ch = curl_init();
$url = 'http://localhost/db.php';
$data= array(
    'title'=>"我是curl提交的title",
    'content'=>'我是curl提交的content'
);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PORT, 1);//设置提交方式
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);//设置数据
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//提交成功,返回为字符串
$result= curl_exec($ch);//执行
curl_close($ch);

var_dump($result);
```

##2.file_get_contents
```php
$data =array(
    'title'=>'asfasf',
    'content'=> 'content',
);

$dataStr = http_build_query($data);
$options = array(
    'http'=>array(
        'method'=>'POST',
        'header'=>"Host:localhost\r\n".
            "Content-type:application/x-www-form-urlencoded\r\n".
                    'content-length:'.strlen($dataStr)."\r\n",
        'content'=>$dataStr
    )
);

$conten = stream_context_create($options);

$url="http://localhost/db.php";
file_get_contents($url,false,$conten);
$handle = fopen($url, 'r',false,$conten);
fclose($handle);
```

##3.socket
```php
$data= array(
    'title'=>"我是soctk提交的title",
    'content'=>'我是octk提交的content'
);

$postData =http_build_query($data);
$length = strlen($postData);


//5 ->连接超时5秒就会断开
$ch = fsockopen('localhost',80,$errno,$error,5);
if(!$ch){
    echo "{$error}({$errno})<br />";
}

$request = "POST http://localhost/db.php HTTP/1.10\r\n";
$request.= "Host:localhost\r\n";
$request.= "Content-type:application/x-www-form-urlencoded\r\n";
$request.= "content-length:{$length}\r\n\r\n";
$request.=$postData;

fwrite($ch, $request);

while(!feof($ch)){
    echo  fgets($ch,1024);
}

fclose($ch);
```