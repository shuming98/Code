<?php 
一、IP域名及DNS(域名服务器)概念
从URL到页面加载发生了什么：
从浏览器输入域名→发送到DNS服务器(进行域名与IP转换)——解析——IP地址——请求HTTP——web服务器——响应——浏览器(电脑)。

二、Apache安装及虚拟主机配置
Apache:80端口  ftp:21端口 ssh:22端口
Apache响应静态文件,不认识PHP需要装PHP解析器。

*Apache如何服务多个域名(一个服务器放多个网站)[没有vhost文件就直接在httpd.conf上写]
1）在apache配置文件"httpd.conf"找到"httpd-vhosts.conf",并取消屏蔽(去掉"#")
2)在apache额外配置文件"httpd-vhosts.conf"输入:

<VirtualHost *:80>
ServerName （域名）           如,www.nglinux.xin
DocumentRoot "对应的网站目录"  如,/Users/www/nglinux
</VirtualHost>

3）重启Apache:路径+restart 、server httpd restart 、systemctl httpd restart

三、Apache整合PHP
*建立Apache与PHP的联系，让Apache能够是被PHP文件
1)在apache配置文件"httpd.conf"找到"#LoadModule",在下面添加:
"LoadModule php5_module PHP安装路径/libphp5.so"
2)还是在"httpd.conf"配置文件找到"DirectoryIndex",修改为:
"DirectoryIndex index.html index.php"
3)重启Apache


/sbin/service httpd configtest    检测apache配置文件有无错
 ?>
