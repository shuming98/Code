一、反向代理

	1.为什么使用反向代理

		1）保护网站安全
			所有web请求都必须先经过代理服务器。
		2）通过配置缓存功能加速web请求
			可以缓存某些静态资源，减轻服务器负载压力。
		3）实现负载均衡
			可以充当负载均衡服务器进行分发请求，平衡集群中各个服务器的负载压力。

	2.与正向代理的区别

	  正向代理：代理客户端，如vpn/ssr；
	  反向代理：代理服务器，静态文件和动态文件分开服务器放，提升网站速度。

二、实现动静分离

	1.要求：准备三台服务器,并安装了Nginx。

	2.操作：服务器A：用户访问，放置静态页面 不解析php 转交给服务器B解析
		   服务器B：放置动态页面 解析php
		   服务器C：放置图片资源
		  (可把整个网站文件传到两个服务器上)

	3.实现：
		1）服务器A(静态文件) nginx.conf文件配置
			a.不开启php解析；
			b.遇php文件转交给服务器B解析
			c.遇到图片资源转交给服务器C

				location ~ \.php$ {
					proxy_pass http://ip:port;
					//服务器2的ip,端口默认80
					proxy_set_header X-Forwarded-For $remote_addr;
					//通过设置头信息字段，把用户IP传到后台服务器
				}

				location ~ \.(jpg|jpeg|gif|png|bmp|swf)$ {
					proxy_pass http://ip:port;
					proxy_set_header X-Forwarded-For $remote_addr;
				}

		2）服务器B(动态文件) nginx.conf文件配置

			a.开启php解析；

				location ~ \.php$ {
				    root           html;
				    fastcgi_pass   127.0.0.1:9000;
				    fastcgi_index  index.php;
				    fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
				    include        fastcgi_params;
				}