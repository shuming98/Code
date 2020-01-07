如,php添加memcached扩展
	1）源码下载：百度pecl->search packages->memcached->复制下载链接

		A.下载源码扩展包：wget http://pecl.php.net/get/memcached-3.1.4.tgz

		B.解压：tar -zxvf memcached-3.1.4.tgz  

		C.进入目录并输入命令：cd memcached-3.1.4 && /usr/local/php/bin/phpize
			(php安装位置下的/bin/phpize)

		D.检测配置：./configure --with-php-config=/usr/local/php/bin/php-config
			(php安装位置下的/bin/php-config)
			(如果报错，缺少某依赖包(看E),就安装上)

		E.缺少某依赖包安装步骤:
			a.下载：wget xxx
			b.解压：tar -zxvf xxx
			c.配置：cd xxx && ./configure --prefix=/usr/local/xxx
			d.编译：make && make install
				(如果编译报错，请查看这个链接解决：https://www.jianshu.com/p/4984c652161f)
			e.返回源码包(D.)检测配置：./configure ....... --with-xxx-dir=/usr/local/xxx 

		F.编译：make && make install
		(编译完成后生成一个 memcache.so 文件,记住文件路径)

		G.配置php.ini文件：添加扩展模块(linux 扩展自动加载,不需要去除;注释)：
			extension=/usr/local/Cellar/php@7.2/7.2.23/pecl/20170718/memcache.so

		H：重启php服务：pkill -9 php && ./sbin/php-fpm
