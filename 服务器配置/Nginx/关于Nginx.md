一、安装
1）准备工作：yum -y install pcre pcre-devel (正则库用于nginx url重写)

2）下载方式：
	①源码包解压编译[位置：/usr/local/nginx]：
		A.wget http://nginx.org/download/nginx-1.17.4.tar.gz
		B.tar -zxvf nginx-1.17.4.tar.gz
		C../configure --prefix=/usr/local/nginx
			[此步如何缺少某依赖包：可以执行以下步骤]
				a.wget 依赖包.tar.gz
				b.tar -zxvf 依赖包.tar.gz
				c../configure --prefix=path & make & make install
				d../confgiure --prefix=/usr/local/nginx --with-pcre=/usr/local/src/pcre-8.39[重新编译nginx]
		D.make & make install
	
	②yum软件包下载：yum install nginx

二、启动nginx服务
1)启动：./nginx [切换到 /usr/local/nginx/sbin 目录下执行]
	[如果连接服务器或启动服务失败，请执行此操作：service iptables stop]
2)重启：nginx -s reload
3)重开日志：nginx -s reopen
4)立即停止：nginx -s stop
5)优雅停止：nginx -s quit
6)检查配置文件：nginx -t

三、配置文件（nginx.conf）
	1）基本
		worker_processer 1;	(worker数目 = cupNum * cpuCores)
		worker_connections 1024;	(一个worker进程最多接受多少连接)
		server_name www.nglinux.xin (域名)

	2）配置虚拟主机(端口、域名、文件路径,日志格式)
		server{
			listen 80;
			server_name domain.com;
			
			access_log logs/access.log main;

			location / {
				root html/path;
				index index.html index.htm;
			}
		}

	3)引入额外配置文件
		include path/*.conf;
	
	4）打开日志[可以手动编写日志格式，并在虚拟主机配置]
		#取消注释以下两行
		"log_format main ..."
		"access_log logs/access.log main;"

四、整合php(开启php解析)

	1)让php监听9000端口[可在/private/etc/php-fpm.d/www.conf处修改]

	2)启动php-fpm服务：sudo php-fpm -D

	3)修改nginx配置文件[去除以下注释，修改fastcgi_param]：
		location ~ \.php$ {
		    root           html;
		    fastcgi_pass   127.0.0.1:9000;
		    fastcgi_index  index.php;
		    fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
		    include        fastcgi_params;
		}

五、重写URL[rewrite 重写样式 原样式]
	1）例如：www.shop.com/goods.php/id=1 ==> www.shop.com/goods/1

		location / {
			rewrite /goods/(\d+) /goods.php?id=$1;
		}

	2）pathinfo支持
		以tp框架为例：www.shop.com/index.php/Home/index/index
		修改以下一行和添加一行：[把pathinfo部分赋给PATH_INFO变量]

		location ~ \.php(.*)${
			fastcgi_param PATH_INFO $1;
		}

	3）try_files[先测试是否为目录，再试是否为文件，最后试url，url部分赋给QUERY_STRING变量]
		Laravel框架部署时需要配置
		
		try_files $uri/ $uri /index.php?$query_string;

六、反向代理->动静分离
	1)正向代理：代理客户端；
	  反向代理：代理服务器，静态文件和动态文件分开服务器放，提升网站速度。

	2)实现动静分离
		①要求：准备两台服务器,并安装了Nginx。
		
		②操作：服务器A：放置静态页面 不解析php 转交给服务器B解析
			  服务器B：放置动态页面 解析php
			  (可把整个网站文件传到两个服务器上)
		
		③实现：
			A.服务器A(静态文件) nginx.conf文件配置
				a.不开启php解析；
				b.遇php文件转交给服务器B:ip

				location ~ \.php$ {
					proxy_pass http://IP:port;
					proxy_set_header X-Forwarded-For $remote_addr;
					//通过设置头信息字段，把用户IP传到后台服务器
				}

			B.服务器B(动态文件) nginx.conf文件配置
				a.开启php解析；

				location ~ \.php$ {
				    root           html;
				    fastcgi_pass   127.0.0.1:9000;
				    fastcgi_index  index.php;
				    fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
				    include        fastcgi_params;
				}

七、负载均衡
	1)负载：用户大量请求
	  均衡：把用户请求均衡分配到多个服务器(集群)上

	2)实现负责均衡(服务器集群)
		①要求：两台以上后台服务器
		②操作：多个服务器放置相同文件,均开启php解析，并配置服务器集群
		③实现：
			A.集群服务器nginx解析php,检测是否都开启了php-fpm服务(能否解析php);
			B.主后台服务器 nginx.conf 配置文件(写server{}外)

				upstream serverGroup {
					server 192.168.56.1:80 weight=1 max_fails=2 fail_timeout=30s;
					server ip:port weight=1 max_fails=2 fail_timeout=30s;
					......
				}

				server{
					location ~ \.php${
						proxy_pass http://serverGroup; 
						//集群服务器名称
					}
				}

		④说明:
			A.weight 代表权重,值越大优先级越高;
			B.max_fails 最大失败次数;
			C.fail_timeout 最大连接时间;

		⑤方式:
			A、轮询(默认) 
				每个请求按时间顺序逐一分配到不同的后端服务器，如果后端服务器down掉，能自动剔除。
			B、weight
				指定轮询几率，weight和访问比率成正比，用于后端服务器性能不均的情况。
			C、ip_hash
				每个请求按访问ip的hash结果分配，这样每个访客固定访问一个后端服务器，可以解决session的问。
			D、fair(第三方)
				按后端服务器的响应时间来分配请求，响应时间短的优先分配。
			E、url_hash(第三方) 	
				按访问url的hash结果来分配请求，使每个url定向到同一个后端服务器，后端服务器为缓存时比较有效。
	 

				
