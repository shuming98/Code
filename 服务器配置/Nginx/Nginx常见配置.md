因操作系统和软件版本不同，内容可能会有出入。
一、Nginx目录

	配置目录：/etc/nginx
	配置文件:/etc/nginx/nginx.conf
	日志目录：/var/log/nginx
	web根目录：/usr/share/nginx/html
	模块目录：/usr/share/nginx/modules
	命令文件:/usr/sbin/nginx

二、配置文件简单介绍

	1.基本
		#worker数目 = cup数量 * cpu核心
		worker_processer 1;	

		#一个worker进程最多接受多少连接
		worker_connections 1024;

	2.配置虚拟主机(端口、域名、文件路径,日志格式)

		server{

			#端口
			listen 80;

			#虚拟主机的域名
			server_name domain.com;

			#日志
			access_log logs/domain.com.access.log main;

			location / {

				#网站根目录，location ~ \.php$处也要修改	
				root html/path; 

				#默认文件，优先级从前到后
				index index.php index.html index.htm;

				#开启目录浏览功能；
				autoindex on;        

				#关闭详细文件大小统计，让文件大小显示MB，GB单位，默认为b； 
        		autoindex_exact_size off;

        		#开启以服务器本地时区显示文件修改日期！  
       			autoindex_localtime on;
			}
		}

		示例:	
			sever{
				listen 80;
				server_name www.nglinux.xin;

				location / {
					root html;
					index index.php index.html index.htm;
				}
			}

	3.引入额外配置文件

		include path/*.conf;

	4.打开日志[可以手动编写日志格式，并在虚拟主机配置]

		1）取消以下两行的注释

			"log_format main ..."
			"access_log logs/access.log main;"

		2）日志参数解析

			$remote_addr      #与$http_x_forwarded_for用以记录客户端的ip地址；
			$remote_user      #用来记录客户端用户名称；
			$time_local       #用来记录访问时间与时区；
			$request          #用来记录请求的url与http协议；
			$status           #用来记录请求状态,成功是200;
			$body_bytes_sent  #记录发送给客户端文件主体内容大小；
			$http_referer     #用来记录从那个页面链接访问过来的；
			$http_user_agent  #记录客户端浏览器的相关信息；

		3)定义日志格式

			log_format mylog '$remote_addr - $remote_user [$time_local] '
							 '$status "$http_referer" '
					         '"$http_user_agent" "$http_x_forwarded_for"';

		4)在Server配置中启动

			access_log logs/server.access.log mylog;

三、重写URL

	1.rewrite规则：rewrite 重写样式 原样式

	示例：www.shop.com/goods.php/id=1 ==> www.shop.com/goods/1

		location / {
			rewrite /goods/(\d+) /goods.php?id=$1;
		}

	2.pathinfo支持

		以tp框架为例：www.shop.com/index.php/Home/index/index
		修改以下一行和添加一行：

		location ~ \.php(.*)${
			#把pathinfo部分赋给PATH_INFO变量
			fastcgi_param PATH_INFO $1;
		}

	3.try_files

		[先测试是否为目录，再试是否为文件，最后试url，url部分赋给QUERY_STRING变量]
		Laravel框架部署时需要配置

		try_files $uri/ $uri /index.php?$query_string;