PHP安装扩展的方法：yum 或 源码包。
本例通过安装Memcached扩展来说明其步骤。

一、yum方式安装扩展

	1.搜索扩展：yum search php74-php-pecl-memcached

	2.安装扩展：yum -y install php74-php-pecl-memcached

二、源码包编译安装扩展

	源码包下载：百度pecl->search packages->memcached->复制下载链接

	1.下载源码扩展包：wget http://pecl.php.net/get/memcached-3.1.4.tgz

	2.解压：tar -zxvf memcached-3.1.4.tgz 

	3.进入目录并输入命令：cd memcached-3.1.4 && /usr/local/php/bin/phpize
		(php安装位置下的/bin/phpize)
		(找不到该文件可执行：find / -name phpize)

	4.检测配置：./configure --with-php-config=/usr/local/php/bin/php-config
		(php安装位置下的/bin/php-config,如果只有一个php版本不需要添加上php-config)
		(如果报错，缺少某依赖包(看第5点),就安装上)

	5.缺少某依赖包安装步骤:

		a.下载：wget xxx
		b.解压：tar -zxvf xxx
		c.配置：cd xxx && ./configure --prefix=/usr/local/xxx
		d.编译：make && make install
			(如果编译报错，请查看这个链接解决：https://www.jianshu.com/p/4984c652161f)
		e.返回第4点检测配置：./configure ....... --with-xxx-dir=/usr/local/xxx 

	6.编译：make && make install
	(编译完成后生成一个 memcache.so 文件,记住文件路径)

	7.配置php.ini文件：添加扩展模块：
		extension=/usr/local/Cellar/php@7.2/7.2.23/pecl/20170718/memcache.so
		(编译后出现的路径)

	8.重启php服务：pkill -9 php && ./sbin/php-fpm
