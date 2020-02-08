LNMP环境搭建和LAMP类似，只是把Apache换成Nginx服务器，其余操作一样，安装MySQL和PHP可查看：link：LAMP环境搭建

一、安装Nginx

	1.安装pcre(解析正则)
		yum -y install pcre pcre-devel

	2.安装nginx
		yum -y install nginx

二、配置

	1.指定配置文件：nginx -c /etc/nginx/nginx.conf

	2.开启php-fpm服务：systemctl start php74-php-fpm

	3.nginx整合php

		1)编辑配置文件/etc/nginx/nginx.conf，并在server{}修改为以下内容

			location / {
		            root   html;
		            index  index.php index.html index.htm;
		        }

				location ~ \.php$ {
				    root           html;
				    fastcgi_pass   127.0.0.1:9000;
				    fastcgi_index  index.php;
				    fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
				    include        fastcgi_params;
				}

		2）检测配置文件并重启服务
			nginx -t 
			nginx -s reload

		link：Nginx常见配置
		link：Nginx反向代理实现动静分离
		link：Nginx实现负载均衡

三、服务

	1.启动：nginx
	2.重启：nginx -s reload
	3.优雅停止：nginx -s quit
	4.立即停止：nginx -s stop
	5.重开日志：nginx -s reopen
	6.检测配置：ngnix -t 

四、防火墙设置

	firewall-cmd --permanent --add-port=80/tcp
	firewall-cmd --reload
	nginx

六、开发环境测试

	1.输入以下命令确保三个服务已开启，80/3306/9000端口在监听

		netstat -natp

	2.vim /usr/share/nginx/html/index.php

		<?php phpinfo(); ?>

	3.开启浏览器输入域名或ip,如果能访问则配置成功。