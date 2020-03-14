零、Redis是一个开源的,内存中的数据结构存储系统,它可以用作数据库、缓存和消息中间件.
	
	1）持久化：Redis不仅把数据存储于内存，还把数据同步到磁盘中.
	2）数据结构类型：哈希、链表、字符串、集合、有序集合.

一、Redis与Memcached的异同

	1）Redis:支持多种数据结构、持久化、主从配置、可以做存储;
	2）Memcached:仅支持字符串、分布式、单纯做缓存;
	3）同：都是NoSQL存储,key-value存储

二、安装

	1）源码安装(你在那个目录解压,根目录就在哪)

		①下载：wget http://download.redis.io/releases/redis-5.0.4.tar.gz
		②解压：tar -zxvf redis-5.0.4.tar.gz
		③编译：cd redis-5.0.4 && make [32位系统使用make 32bit]

	2）配置文件(cd redis-5.0.4 目录下操作)

		①指定安装位置：make PREFIX=/usr/local/redis install
		②复制配置文件：cp redis.conf /usr/local/redis/
		③切换目录：cd /usr/local/redis/
		④修改配置文件[设置后台运行]：sudo vim redis.conf   ---> [daemonize yes]
		⑤启动服务[并加载配置文件]：./bin/redis-server ./redis.conf

三、基本操作

	0）关闭配置项：config set stop-writes-on-bgsave-error no

	1）开启服务(端口号：6379)：./redis_server

	2）客服端连接：./redis-cli -h localhost -p 6379

	3）对key的通用操作

		A.添加：set key value ex 秒数 nx/xx  [nx 不存在时执行,xx反之]
		B.查询：get key
		C.删除：del key

		D.修改键名：rename key newkey
		E.正则查询：keys pattern 		   
			(keys * 显示所有key，慎用！！！大量输出结果会down掉服务器)
		
		F.转移key到其他仓库：move key db(0-15)  
			(redis默认把仓库分成16个仓库，编号分别为0-15)
		G.选择仓库：select index(0-15)
		
		H.随机返回键：randomkey
		I.键是否存在：exists key
		J.返回key的值类型：type key
		
		K.查询生命周期：ttl key 		
			(不存在/过去key返回 -2 ，不自动失效的key返回 -1,其余返回声明周期 秒数)
		L.设置key生命周期：expire key seconds 
		M.设置key为永久有效：persist key

	4）字符串类型的操作

		A.设置多个键值：mset key1 v1 key2 v2 ....
		B.获取多个key的值：mget key key2 ....
		C.修改字符串中某个字母：setrange key offset value
		D.获取字符串中[start,stop]范围的值：getrange key start stop 
			(offset,start,stop 均为数字,如getrange key 0 -1)
		E.追加value到原值上：append key value
		F.设置key新值,并返回旧值：getset key newvalue

		G.key的值+1：incr key
		H.key的值-1：decr key
		I.key的值+n：incrby key num
		J.key的值-n：decrby key num
		K.key的值+n.n：incrbyfloat key float
			(应用场景：例如点赞、阅读、下载数等)

		L.获取二进制位上的值：getbit key offset
		M.设置二进制位上的值：setbit key offset value
			(实际应用,用于记录用户登陆：每天按照日期生成一个位图,用户登录后,user_id上的bit值置为1,再用bitcount统计用户上线次数)
		N.对key做位运算：bitop operation[and,or,not,xor] destkey[结果保存key] key key2
		O.统计字符串被设为1的位数：bitcount key start stop

	5）list链表的操作
		(start、stop、index 均为正负整数,类似于索引数组)

		A.把值插入到链表头部：lpush key value ...
		B.把值插入到链表尾部：rpush key value ...
		C.返回并删除链表头部：lpop key
		D.返回并删除链表尾部：rpop key

		E.返回链表中的元素：lrange key start stop
		F.返回索引上的值：lindex key index
		G.返回链表的元素个数：llen key

		H.移除某value元素：lrem key count value
			（count>0：从表头搜索，移除数量为count；count<0：从表尾搜索,移除数量为count；count=0：移除所有value）
		I.删除范围外的元素：ltrim key start stop

	6）集合set的操作
		(集合的性质：唯一性,无序性,确定性;适用于表达对象间关系)

		A.添加元素：sadd key value value2
		B.删除元素：srem key value value2

		C.删除并返回1个随机元素：spop key
		D.返回1个随机元素：srandmember key
		E.返回所有元素：smemebers key
		F.返回元素个数：scard key

		G.判断value是否在集合中：sismember key value
		H.转移元素到另一集合中：smove source dest value

		I.求交集∩：sinter key key2 ...
		G.求交集并赋值给dest(ination)：sinterstore dest key key2 ...
		K.求并集∪：sunion key key2 ...
		L.求差集：sdiff key key2 ...

	7）有序集合
		(集合中添加权重score,让集合变得有序,排名从0开始)

		A.添加元素：zadd key score value score2 value2 ...

		B.返回元素个数：zcard key
		C.返回范围里元素个数：zcount key min max

		D.查询元素排名(升序)：zrank key member
		E.查询元素排名(降序)：zrevrank key member

		F.返回元素(升序)：zrange key start stop [withscores]
		G.返回元素(降序)：zrevrange key start stop [withscores]
		H.返回元素(按score升序,跳n取m)：zrangebyscore key min max limit offset m [widthscore]

		I.删除元素：zrem key value value2
		J.删除元素(按照score)：zremrangebyscore key min max
		K.删除元素(按照排名)：zremrangebyrand key start end
	
	8）Hash哈希的操作
		(类似于关联数组)
		
		A.添加filed的值：hset key field value
		B.添加多个值：hmset key field value field2 value2 ...

		C.返回域与值：hgetall key
		D.返回field的值：hget key field
		E.返回多个field的值：hmget key field field2 ...
		F.返回所有value：hvals key
		G.返回元素数量：hlen key	

		I.判断是否存在field：hexists key field
		J.删除field：hdel key field

		K.value整数自增：hincrby key field value
		L.value浮点数自增：hincrby float key field value
	
	9）flush (别用)

		A.删除当前数据库：flushdb
		B.删除所有数据：flushall
	
	10）scan 列出数据（会返回10个key）

	 	A.scan curson match key
	 	 	(例如,scan 0 match k*,列出前10个数据,此时游标在9，再次使用,获取下一页数据)

	11）事务(redis采用乐观锁：只负责检测key有没改动;mysql可以采用悲观锁：事务开启时保护好数据)
	
		A.监听变量：watch key
		B.事务开启：multi
		C.事务过程语句：普通命令decr/decrby/incr/incrby
		D.事务失败(取消)：discard
		E.事务成功(提交)：exec
		F.取消监听：unwatch

	12）发布与订阅（简单的消息队列）
		
		A.订阅频道：subscribe channel
		B.发布信息：publish channel message 
			(返回监听数)