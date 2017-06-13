#系统需求 
    网址:https://lamp.sh/install.html
    
    系统支持：CentOS 6+/Debian 7+/Ubuntu 12+
    内存要求：≥ 512MB
    硬盘要求：至少 2GB 以上的剩余空间
    服务器必须配置好 软件源 和 可连接外网
    必须具有系统 root 权限
    强烈建议使用全新系统来安装
    支持组件

    支持 PHP 自带几乎所有组件
    支持 MySQL、MariaDB、Percona Server数据库
    支持 Redis（可选安装）
    支持 XCache （可选安装）
    支持 Swoole （可选安装）
    支持 Memcached （可选安装）
    支持 ImageMagick （可选安装）
    支持 GraphicsMagick （可选安装）
    支持 ZendGuardLoader （可选安装）
    支持 ionCube Loader （可选安装）
    自助升级 Apache，PHP，phpMyAdmin，MySQL/MariaDB/Percona Server至最新版本
    命令行新增虚拟主机（使用 lamp 命令），操作简便
    支持一键卸载
    安装步骤

#事前准备（安装 wget、screen、unzip，创建 screen 会话）
注意：双斜杠//后的内容不要复制输入

    yum -y install wget screen unzip // for CentOS
    apt-get -y install wget screen unzip // for Debian/Ubuntu
    
    下载、解压、赋予执行权限
    wget -O lamp.zip https://github.com/teddysun/lamp/archive/master.zip
    unzip lamp.zip
    cd lamp-master/
    chmod +x *.sh

#安装 LAMP 一键安装包
    screen -S lamp
    ./lamp.sh
    
    组件安装
    
    关于本脚本支持的所有组件，都可以在脚本交互里可选安装。
    
    使用提示
    
    lamp add 创建虚拟主机
    lamp del 删除虚拟主机
    lamp list 列出虚拟主机

#如何升级

    注意：双斜杠//后的内容不要复制输入
    
    ./upgrade.sh // Select one to upgrade
    ./upgrade.sh apache // Upgrade Apache
    ./upgrade.sh db // Upgrade MySQL/MariaDB/Percona
    ./upgrade.sh php // Upgrade PHP
    ./upgrade.sh phpmyadmin // Upgrade phpMyAdmin

#如何卸载

./uninstall.sh

程序目录
    
    MySQL 安装目录: /usr/local/mysql
    MySQL 数据库目录：/usr/local/mysql/data（默认，安装时可更改路径）
    MariaDB 安装目录: /usr/local/mariadb
    MariaDB 数据库目录：/usr/local/mariadb/data（默认，安装时可更改路径）
    Percona 安装目录: /usr/local/percona
    Percona 数据库目录：/usr/local/percona/data（默认，安装时可更改路径）
    PHP 安装目录: /usr/local/php
    Apache 安装目录： /usr/local/apache
    命令一览
    
    MySQL 或 MariaDB 或 Percona 命令
    /etc/init.d/mysqld (start|stop|restart|status)
    
    Apache 命令
    /etc/init.d/httpd (start|stop|restart|status)
    
    Memcached 命令（可选安装）
    /etc/init.d/memcached (start|stop|restart|status)
    
    Redis 命令（可选安装）
    /etc/init.d/redis-server (start|stop|restart|status)
    
    网站根目录
    
    默认的网站根目录： /data/www/default