*先了解，遇到某种情况需要用到时，根据情景做出解决方案。
*学会解决问题
零、Memcached是一款自由并且开源,高性能、分布式的内存对象缓存系统。
   NoSQL指的是非关系型数据库,相对于传统关系型数据库的行列规范，NoSQL鲜明特点是k-v存储或文档存储。

一、安装

	1）源码安装

		A.下载源码包：wget http://www.memcached.org/files/memcached-1.5.19.tar.gz
		B.解   压：tar -zxvf memcached-1.5.19.tar.gz
		C.切换目录：cd memcached-1.5.19.tar.gz
		D.检查配置：./configure --prefix=/usr/local/memcached
		E.编译安装：make && make install

	2）解决依赖包
	   A.从官网下载依赖包：wget xx
	   B.解   压：tar -zxvf xx
	   C.检查配置：./configure --prefix=/usr/local/xxx(指定安装路径)
	   D.编译安装：make && make install
	   E.重新返回 1）D.检测配置：
	   		./configure --prefix=/usr/local/memcached --with-libevent=/usr/local/xxx(告诉系统依赖包路径)
	   或
	   F.软件包管理器安装后，返回 1）D.步骤

二、基本使用(不建议root用户启动,默认端口：11211)

	1）启动服务(参数：-u 用户身份 -m 内存/MB -p 端口号 -vvv 输出至屏幕 -f 增长因子,默认1.25)：

		cd /usr/local/memcached/bin 
		./memcached -u nobody -m 64 -p 11211 -vvv
		./memcached -u nobody -m 64 -p 11211 &  //后台运行

	2）连接memcached：telnet localhost 11211

	3）添加缓存：add key flag expire value_length
		(如,add title 0 10 5 -> hello)

		(add 键 标志[区分数据类型] 有效期[秒,时间戳] 值字节长度)

		[flag：比如我们定义 1：是字符串 2：是反转数组 3：是反序列化对象;
		当存储时serialize()转化为字符串;取值时反序列化转化为对象/数组/json等.]

		[expire：0 不自动失效;3600*24*30 是最大值;time()+30*3600*24 可使时间超过30天]
			 

	4）查询缓存：get key
			   
	5）删除缓存：delete key	

	6）修改缓存：replace key flag expire length

	7）设置缓存(用法和add,replace一样,有则改之,无则加勉):set key flag expire length

	8）增减值大小：incr/decr key num 
		(应用例如：秒杀场景。利用memcached的incr/decr功能,在内存存储count库存量,每个人抢单在内存操作,速度快,抢单成功后再有效期内支付,减轻传统数据库压力)

	9）统计命令：stats 

	10）清空所有存储对象(慎用)：flush_all

三、php添加memcached扩展

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

四、PHP操作Memcached
	
	$mem = new Memcached(); //实例化对象
	
	$mem->addServer('localhost',11211); //链接服务器
	
	$mem->add('title','hello world'); //添加缓存

	$mem->get('title'); //查询缓存

	$mem->delete('title'); //删除缓存

	$mem->replace('title','wordpress'); //修改缓存


五、缓存实战(减少数据库压力)

	$mem = new Memcached(); //new memcached类
	$mem->addServer('localhost',11211);
	$res = $mem->get('news');

	if(empty($res)){ //判断缓存是否存在，不存在就查库->add，存在就直接用缓存
		$pdo = new PDO('mysql:host=localhost;dbname=p2p','root','123456');
		$pdo->query('set names utf8');
		$sql = 'select pid,title,money from projects';
		$data = $pdo->query($sql)->fetchAll();
		$mem->add('news',$data,10);
		echo 'from mysql';
	}else{
		echo 'from memcached';
	}


六、经常问题或现象

	①雪崩现象：缓存服务器挂了,造成DB服务器雪崩.
	>解决方案：随机3-9小时缓存;在访问低峰期(凌晨)使缓存失效;

	②无底洞现象：连接次数增加并没有随着节点的增加而降低连接频率。
	以用户信息为例,把用户信息以键的形式存放在同一台服务器上。

七、Memcached内存管理与删除机制

	1）内存碎片化：内存在申请和释放过程中，会形成一些很小但没法再利用的内存空间。

		
	2）slab allocator 原理(缓解内存碎片化)：[内存->slab->chunk<-content]

		①把内存划分成数个slab class库(MB）,每个slab库切成不同尺寸的chunk小块(byte),存储内容时，根据大小自动选择合理的slab仓库。

		②如果系统选择的仓库已经满了,它会自动删除使用率不高的数据。

		③chunk空间问题是无法彻底解决的,开发者可根据缓存item长度进行统计,调整合适的增长因子。

	3）删除机制：

		①惰性删除：过期数据并没有从内存中删除,当用户get其值时才判断数据是否过期.(存在于1.5版本以下,1.5版本及以上会自动清除过期数据)

		②LRU删除(least recently used:最近最少使用)：当某单元被请求是，通过计数器判断最近谁(哪些数据)最少使用，然后将其删除.此算法会将永久数据删除.
		
		③由于删除机制存在，永久数据会出现被踢现象,解决方案：永久数据和非永久数据分开存放.

八、memcached 参数限制

	①key的长度：250字节;
	②value限制1mb;
	③内存限制：32位下最大设置到2g;
	④如果有30g数据要缓存,一般不会单实例装30g,建议开启多个实例;

九、分布式集群

	①memcached分布式的实现靠用户设计算法,把数据分布在多个节点中,分布式其实就是多台服务器分配工作量的方法。
	
	②crc32()取模算法：假设有 N 个节点,设计编号为 0->N-1 ,key对 N 取模得余数 i ,则key放在第 i 台服务器上。如果其中一台服务器down掉,命中率会下降到 1/N;

	如,你有3台服务器,1号数据放在第 1%3= 1 号服务器,2号数据放在第 2%3= 2 号服务器,3号数据放在第 3%3= 0 号服务器,如此类推.
	
	③一致性哈希算法：创建多个虚拟节点形成一个圆环,某节点down掉后分散转移访问压力,以达到理论上的(N-1)/N的命中率.

	把服务器节点映射到钟表的各时刻上,key也映射到钟表某时刻上,key沿钟表顺时针走,遇到第N个节点,就存储第 N个key的值.假设有12个虚拟节点,key:node,1->1,13->1.

	当某个节点down掉后,会把访问压力转移到下一节点,以达到命中率(N-1)/N.

	假设有A,B,C,D四台服务器,分别创建了a0,a1,a2,b1,b2,b3,c1,c2,c3,d1,d2,d3虚拟节点,当A服务器down掉后,a1,a2,a3虚拟节点会向其余三台服务器转移,a1->c2,a2->b3,a3->d1.

十、PHP实现一致性hash算法

	<?php
	$mem = new Memcached();

	$mem->setOptions(array(
		//一致性hash
		Memcached::OPT_DISTRIBUTION=>Memcached::DISTRIBUTION_CONSISTENT,
		Memcached::OPT_LIBKETAMA_COMPATIBLE=>true,
		//如果服务器down掉
		Memcached::OPT_REMOVE_FAILED_SERVERS=>true,
	));

	//本地开三个memcache进程,假设有三个服务器
	$mem->addServers(array(
	 array('localhost',11211),
	 array('localhost',11212),
	 array('localhost',11213)
	));

	$mem->add('name','wangwu');
	$mem->add('age',18);
	$mem->add('title','today is sunshine');
	$mem->add('xm','wsm');

	var_dump($mem->get('name'),$mem->get('age'),$mem->get('title'),$mem->get('xm'));
	?>