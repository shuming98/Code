一、负载均衡——给服务器减减压

	1.负载：用户大量请求。
	2.均衡：把用户请求均衡分配到多个服务器(集群)上。

二、实现负载均衡(服务器集群)

		1.要求：两台以上后台服务器
		2.操作：多个服务器放置相同文件,均开启php解析，并配置服务器集群
		3.实现：

			1）集群服务器配置nginx解析php,并检测是否都开启了php-fpm服务(能否解析php);
			2）主后台服务器 nginx.conf 配置文件(写server{}外)

				upstream serverGroup {
					server 192.168.56.1:80 weight=1 max_fails=2 fail_timeout=30s;
					server ip:port         weight=1 max_fails=2 fail_timeout=30s;
					......
				}

				server{
					location ~ \.php$ {
						#集群服务器名称
						proxy_pass http://serverGroup;

					}
				}

		4.说明:

			A.weight        #代表权重,值越大优先级越高;
			B.max_fails     #最大失败次数;
			C.fail_timeout  #最大连接时间;

		5.方式:

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