因操作系统和软件版本不同，内容可能会有出入。
一、Apache目录

	根目录：/etc/httpd
	配置文件：/etc/httpd/conf/httpd.conf
	额外配置：/etc/httpd/conf.d
			/etc/httpd/conf.modules.d
	日志目录：/etc/httpd/logs
			/var/log/httpd
	模块目录：/etc/httpd/modules
	web根目录：/var/www/html
	命令文件:/usr/sbin/httpd

二、配置文件简单介绍

	ServerRoot    #根目录
	Listen        #端口号
	ServerAdmin   #邮箱
	DocumentRoot  #web目录
	ServerName    #域名
	ErrorLog      #错误日志保存路径
	CustomLog     #访问日志保存路径 common
	LogFormat     #日志记录格式

三、如何配置虚拟主机

    1.在httpd.conf 或 /etc/httpd/conf.modules.d/00-base.conf 配置文件中找到以下这行并去掉开头的'#'号注释

    		LoadModule vhost_alias_module modules/mod_vhost_alias.so

    2.编辑虚拟主机文件
    	1）vim /etc/httpd/conf/extra/httpd-vhosts.conf
    	2）如果没有该文件，vim /etc/httpd/conf.d/vhosts.conf

    	官方模板：

    	<VirtualHost *:80>
    	    ServerAdmin user@qq.com
    	    DocumentRoot "/var/www/html"
    	    ServerName www.test.com
    	    ErrorLog "logs/www.test.com-error.log"
    	    CustomLog "logs/www.tes.com-access.log" common
    	</VirtualHost>

    	例子:

    	<VirtualHost *:80>
    	    ServerName www.nglinux.xin
    	    DocumentRoot /var/www/html/
    	</VirtualHost>

四、如何开启重写功能

	1.在httpd.conf 或 /etc/httpd/conf.modules.d/00-base.conf 配置文件中找到以下这行并去掉开头的'#'号注释

		LoadModule rewrite_module modules/mod_rewrite.so

	2.修改httpd.conf配置文件

		AllowOverride All