#登入ssh远程
    输入vi /etc/ssh/sshd_config
    按i
    在最后面增加ClientAliveInterval 60
    按esc键
    输入:wq回车
    cd /
    mkdir www
    cd /www/
    wget http://dl.wdlinux.cn:5180/lanmp_laster.tar.gz
    tar zxvf lanmp_laster.tar.gz
    sh install.sh 或者lanmp.sh
    选4回车
    选1回车，需要几个小时，安装中不要关机断网

#安装完后
    http://ip:8080
    用户名:admin 
    默认密码:wdlinux.cn 改成5asd6asj22ec
    mysql默认的管理用户名:root 默认密码:wdlinux.cn 改成aqcxxj321

    http://ip:8080中找到mysql设置修改
    最大连接数max_connections：3000
    连接时间wait_timeout：5000
    缓冲key_buffer_size：256M
    查询缓存query_cache_size：16M
    表缓存table_open_cache：256
    临时表大小tmp_table_size：32M

##找到php设置修改

    URL打开文件 allow_url_fopen：开
    错误信息 display_errors：关
    全局变量 register_globals：开
    使用内存量 memory_limit：128M
    POST最大字节数 post_max_size：20M
    允许最大上传文件 upload_max_filesize：20M
    程序最长运行时间 max_execution_time：1200
    点击在线编辑文件，查找
          output_buffering =改为on
          session.auto_start = 1
          session.gc_maxlifetime = 144000


    改httpd.conf 端口号88 改成 80 ，listen 88改成80
#在httpd.conf最后加上
    <VirtualHost *:80>
    DocumentRoot /www/web/hoogege2016/public_html
    ServerName search.hoogege.com
    ErrorDocument 400 /errpage/400.html
    ErrorDocument 403 /errpage/403.html
    ErrorDocument 404 /errpage/404.html
    php_admin_value open_basedir /www/web/hoogege2016:/tmp
    <IfModule mod_deflate.c>
    DeflateCompressionLevel 7
    AddOutputFilterByType DEFLATE text/html text/plain text/xml application/x-httpd-php
    AddOutputFilter DEFLATE css js html htm gif jpg png bmp php
    </IfModule>
    </VirtualHost>
    <Directory /www/web/hoogege2016>
        Options FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    
    
    重启服务器 reboot
    
    scp root@107.151.241.214:/www/web/hoogege2016.zip /www/web/
    8fe5f1c3a40f
    
    cd /www/web
    unzip hoogege2016.zip
    chmod -R 755 hoogege2016
    chown -R www:www hoogege2016
    
    数据库从107.151.241.214上拿，账号密码一样