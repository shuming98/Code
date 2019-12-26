								---目录---

		一、表优化
		二、列选择原则
		三、索引优化
		四、sql语句优化
		五、事务transaction
		六、主从复制与读写分离
		七、表分区
		八、Mysql运维
		九、sphinx(斯芬克斯)全文搜索引擎
		十、状态监测zabbix
		十一、服务器性能测试工具Sysbench

一、表优化
	1.定长与变长分离。
		定长 int char(4) time   所有定长字段叫fixed结构
		变长 varchar text blob  用主键关联起来

	2.常用字段与不常用字段分离。

	3.在一对多，需要关联统计的字段上，添加冗余字段。如栏目表增加文章数量字段

二、列选择原则
	1.字段类型优先级：
		int>date,time>emum,char>varchar>blob,text

	>>存储性别，以utf8字符集为例
		char(1) 占3个字节
		emum('男','女') 起到约束值的目的，内部转成数字（1,2）来存，查询时多了一个转换过程
		tinyint(1) //0 1 2 占1个字节√

	2.够用就行，不要慷慨 
	>>如存储年龄，tinyint unsigned no null
	>>varchar(10)

	3.尽量避免写NULL

三、索引优化（通俗说，就是数据的目录，提高查询速度和排序速度）
	1.B-tree索引（二叉树遍历实现，排好序的快速查找结构）
		①常见误区：
			A.常用列都加上索引（查询时，独立索引只有一个能发挥作用）
			B.联合索引能让查询的字段都发挥作用（左前缀原理：前者被使用且是精准等于某值，后者索引才生效）
				>>如,index unite(c1,c2,c3,c4)
				a.where c1=1 and c2=2 and c4>4 and c3=3; 
					>>>c1,c2,c3,c4都起到索引作用
				b.where c1=1 and c2=2 and c4=4 order by c3;
					>>>c1,c2起到索引作用，c3排好序
				c.where c1=1 and c4=4 and group by c3,c2;
					>>>c1起到索引作用，c3,c2顺序无法利用索引		
				d.where c1=1 and c5=5 order by c2,c3;
					>>>c1起到索引作用，c2,c3发挥了排序作用
				e.where c1=1 and c2=2 and c5=5 order by c2,c3;
					>>>c1,c2起到索引作用，c2是定制不参与排序

	2.Hash索引（常用于内存引擎表，用数学函数算）
		①过程：构建一个规律函数，使数据重复性少，离散性大。传一个具体精确的值，能找到数据位置。
		>>如，f(x) = x^2-3x+1
		②缺点：不对范围查询优化；无法使用前缀索引my* ；排序无法优化；必须回行（通过索引拿到数据位置，必须回到表中取数据）

	3.聚簇索引与非聚簇索引
		1）了解：
		  ①聚簇索引：主键索引结构中，既存储主键值，又存储行数据。
		  	A.优势：主键查询条目比较少时，不用回行（数据在主键节点下）。
		  	B.劣势：主键碰到不规则数据（如随机值）插入时，会造成频繁的页分裂。
		  	C.高性能索引策略：
		  		a.节点下数据文件，分裂比较慢；
		  		b.主键尽量使用递增的整形；
		  		c.主键不要用随机字符串或uuid，否则会产生页分裂，影响速度。

		  ②非聚簇索引：只存储索引主键值，行数据存储在磁盘上（索引数据分离）

		2）引擎：
		 ①innodb引擎：主索引文件直接存储该行数据，成为聚簇索引，次索引指向对主键的引用。
		 >>注意：对innodb来说，
			 A.主键索引既存储索引值，又在叶子中存储行的数据；
			 B.如果没有主键（primary key），会向后找(unique key)或系统内部生成一个主键（rowid）。
		 ②myisam引擎：主索引和次索引的数据，都指向物理行（磁盘位置table.MYD[data数据文件]、table.MYI[index索引文件]）。

	4.索引覆盖：查询的列恰好是索引的一部分，那么查询只需要在索引文件上进行，不需要回行到磁盘上找数据。（索引中有你想要的数据，不需要回行）。
		A.这种查询速度非常快,特别体现在myisam非聚簇索引上。
		>>如，select id from user where id > 10;
		B.如果是innodb聚簇索引，而且有许多不规则数据（造成页分裂），查询时要跳过好多块导致速度会被拖慢，甚至不如联合索引速度快。
		>>如，select id from user order by id,uid;

	5.理想的索引：查询频繁、长度小、区分度高、尽量能覆盖常用查询字段
		a.索引长度影响索引文件大小，影响增删改的速度，间接影响查询速度（占用内存多）
		b.要在区分度和长度两者上，取得一个平衡

		>>惯用手法（检测区分度与长度之间的关系）：截取不同长度，并测试其区分度。
			>>>select count(distinct left(word,n)/count(*)) from table;

		>>针对字段建制定长度索引
			>>>index content(content(100));

		>>对于左前缀不易区分的列，建立索引技巧
			如，url列
			>>>把数据倒过来存储(在php函数实现)，并建立索引（这样左前缀区分度大）。
			或>>>伪hash索引效果
				添加一列:add urlcrc int unsigned not null
				(php操作)存储数据时urlcrc=crc32(url);

		>>建立多列索引：以escshop商场为例，goods表中的cat_id，brand_id做多列索引。
			>>>根据实际业务来看，那些字段查询频率高，查询的顺序；
			用户购买时点击网页的想法：点分类直接点价格，或点分类再品牌后价格
			最终选择建立联合索引如下：index(cat_id,price)；index(cat_id,brand_id,price)

		6.索引与排序：索引在排序中也发挥作用。

		7.重复索引与冗余索引
			重复索引：创建了相同的索引。
			冗余索引：两个索引所覆盖的列有重叠。

			>>如，博客文章与标签表有id,artid,tag
			实际使用中，需要用用artid查出tag,tag查出artid,这种互查情况，如何建立索引？
				>>>index arttag(artid,tag);
				index tagart(tag,artid);

		8.索引碎片与维护（根据操作频率来按一个周期修复）
			myisam引擎：optimize table 表名
			innodb引擎：alter table 表名 engine innodb

四、sql语句优化
	1.sql语句的时间花在：等待时间和执行时间（查找、排序、取出）。
	2.如何提高sql语句查询速度？
		A.利用联合索引的顺序、区分度、长度来加速查询速度；
		B.使用索引覆盖（不用回行），取数据快；
		C.利用索引排序或不排序，免除firesort过程；
		D.查询更少的行和列。

	3.sql优化思路：不查->少查->高效查
		A.不查：有些数据不需要精确，可以通过业务逻辑来计算(程序估算)，如注册数量，在线访问数；
		B.少查：尽量精准数据，少取行；
		C.高效查：利用索引查询

	4.explain详解
		[语句编号]id:
		[查询类型]select_type:simple(不含子查询)、primary(含子或派生查询){subquery(非from子查询)、derived（from子查询）、union、union result}
		[表名]table:
		[**查询方式]type（分析‘查数据过程’的重要依据）:all(全表扫描，不应用于生产环境)、index（扫描所有索引）、range（根据索引范围优化）、ref(通过索引引用某些行)、eq_ref(通过索引连表查询某些行)、const/system/null（常量级别优化，最佳）
		[可能用到的索引]possible_keys（分析索引用于查询的过程）:
		[最终用到的索引]key（索引用于查询、排序或索引覆盖。可能出现上面是null，这里不为null的情况）:
		[索引最大长度]key_len:
		[连接查询时，表之间引用关系]ref:
		[估计扫描多少行]rows:
		[额外说明]extra:using index（用到索引覆盖）、using where（用到where辅助判断）、using temporary（group by与order by列时会用上临时表）、using filesort（用到文件排序）

	5.子查询语句优化技巧
		1）多使用索引查询

		2）count()优化：myisam的count()函数查询'所有行'速度比较快，但遇到条件查询速度就不再快了。遇到需要统计上百万行数据可以如此
		>>如，select count(*) from xx where id > 100;
			>>>select(select count(*) from xx - select count(*) from xx where id<100) 

		3)group by优化：分组用于统计平均分、最高分，而不用于筛选重复数据。group by 索引列，且order by 与group by 列一致最佳。

		4）union优化：尽量查询更少的行，去重复先排序。

		5）in子查询陷阱（不要用直觉去判断，要以结果为准）
			>>如，查询某大类下小类的所有商品
				>>>select goods_id,cat_id from goods where cat_id in (select cat_id from category where parent_id=6)；
				你的直觉上，它会先处理内部获取cat_id，根据其查询商品表。
				但实际上，系统会全表查询goods表，一行行取goods.cat_id跟category.cat_id相比较，符合的取出。(全表查询每一条数据与category.cat_id对比)执行速度非常慢。

				>>>select goods_id,goods.cat_id from goods inner join (select category.cat_id from category where parent_id=6) as tmp on goods.cat_id = tmp.cat_id; 
				改进，使用连表查询，系统会先查category表，取出cat_id，再全表查询goods表中满足category.cat_id的。（全表查询goods.cat_id=category.cat_id）

		6）exists子查询
		>>查询有商品的栏目
			>>>select c.cat_id,cat_name from category as c inner join goods using(cat_id) group by c.cat_id;

			>>>select cat_id.cat_name from category where exists(select * from goods where goods.cat_id=category.cat_id)

		7）from型子查询：内层语句查到的临时表是没有索引的，所以from返回的内容尽量要少，需要排序，在内层先排好序。
		>>select cat_name from category inner join (select goods.cat_id from goods group by goods.cat_id) using(cat_id);

		8）limit翻页优化
		>>当实现翻页功能时，会使用limit M,N ,跳过M行，取N行，但实际上这条语句是取了M+N行，再扔掉M行，当数据量十分大（上万条）时，内存会爆炸，执行效率超级低，这时就需要去优化。
			>>>业务上去解决，限制用户翻页数量（不允许超过100页）

			>>>不用offset,改用条件查询
			（要求数据id是有序，没被删除过，数据主键不完整会出现结果不一致的情况。。一般来说，大网站的数据都是不物理删除，指做逻辑删除，如is_delete = 1）
				select id,name from art limit M,N;——改为——>select id,name from art where id>M limit N;

			>>>如果非要物理删除，还要精确查询，还不限制用户分页，可以如此优化
			(先用覆盖索引查出id，再查内容，using(id)等同于on a.id=b.id)
				select id,name from art inner join (select id from art limit M,N) as tmp using(id);

五、事务transaction
	1）事务4个特性ACID：原子性（Atomicity）、一致性（Consistency）、隔离性(Isolation)、持久性(Durability)
		①原子性：指几句sql影响，要么都发生，要么都不发生（过程）
		②一致性：事务前后数据，保持业务上的合理一致（结果）
		③隔离性：事务进行中，外部没法观察此事务效果
		④持久性：事务一旦发生，不能取消。只能通过补偿性事务来抵消效果。

	2）事务与引擎：myisam不支持，innodb和BDB引擎支持。

	3）事务使用流程：
		①开启事务：start transaction
		②执行查询：sql....
		③提交事务/回滚事务：commit/rollback

	4)事务隔离级别设置：set session transaction isolation level [repeatable read]
		①read uncommitted:'脏读'，事务进行时可被其他会话读到，业务上没人使用。
		②read committed:别的会话可读已提交后的事务。
		③repeatable read:可重复读，事务未结束前，不受其他会话干扰。大多数系统，使用此隔离级别。
		④serializable:序列化，所有事务按编号顺序一个个执行，取消了冲突的可能，隔离级别最高，但等待时间长，实际使用不多。

六、主从复制与读写分离（备份主服务器数据，分担查询压力）
	1）主从原理:从服务器读取主服务器的binlog,并转换为自身可执行的relaylog,过程如下：

		主：开启binlog（二进制日志功能） , 从：开启relaylog
		主：设置从账号权限（授予读binlog权限），从：利用账号，连接主服务器
		主：start , 从：start slave

	2）具体实施（主从配置过程，除配置文件外，命令皆在mysql内执行）
	准备：两台服务器及以上

		①主服务器开启binlog, 从服务器开启relaylog

			A.主服务器开启binlog
				a.my.cnf文件配置
					vi my.cnf 
						[mysqld]
						server-id=249 (通常写ip最后一个字段)
						log-bin=mysql-bin（开启二进制日志）
						binlog-format=mixed（指定日志格式）

				b.配置完成后，重启服务
				   ./bin/mysqld_safe --user=mysql &（重启mysql服务）
				   mysql -uroot -p（进入mysql）
				   show master status(查看主服务器状态)

			B.从服务器开启relaylog
				a.my.cnf文件配置
					vi my.cnf
						[mysqld]
						server-id=165 (ip最后一位)
						relay-log=mysql-relay（中继日志）
						read-only=1（只读）

				b.配置完成后，重启服务
				    ./bin/mysqld_safe --user=mysql &
					mysql -uroot -p
					show slave status（查看从服务器状态）

		②主服务器创建从服务器复制账号权限，从服务器连接主服务器
			A.主服务器创建复制账号
				grant replication slave,replication client on *.* to repl@'192.168.1.%' identified by 'repl';
				（user@'从服务器ip' identified by 'passwd'）
				flush privileges;(刷新权限)

			B.从服务器连接主服务器
				change master to 
				master_host='192.168.1.249',（主服务器ip）
				master_user='repl',
				master_password='repl',(复制账号用户名和密码)
				master_log_file='mysql-bin.000001',
				master_log_pos=619;
				(最后两行主服务器在mysql输入'show master status'命令查看)

		③从服务器开启slave:start slave

	3）主从复制常用语句
		①查看主服务器状态（尤其日志及位置）：show master status 
		②查看从服务器状态：show slave status
		③开启/重置/暂停slave状态：start/reset/stop slave

	4)日志格式（statenebt、row、mixed）
		statement:抄语句；
		row:抄结果，直接复制磁盘上的新增变化；
		mixed:前两种混合，使用它，系统会自动判断。

	5）读写分离与中间件
		①目的：master主服务器执行insert,update,delete操作；slave从服务器执行select操作

		②实现
			A.修改mysql类

				class mysql{
					$dbm = 主服务器；
					$dbs1 = 从服务器；

					public function query(){
						在query里面进行语句判断，分别连接不同的mysql服务器
					}
				}

			B.使用中间件（不需要修改mysql类情况下，在中间弄一个mysql_proxy负责路由选择）
				a.官方集群中间件：mysql_proxy
				b.国产中间件：amoeba

				c.mysql_proxy中间件如何实现负载均衡和读写分离？
					1.下载安装并解压：

						http://mysql.cdpa.nsysu.edu.tw/Downloads/MySQL-Proxy/mysql-proxy-0.8.4-linux-glibc2.3-x86-64bit.tar.gz

					2.执行mysql_proxy:

						./mysql-proxy-path/bin/mysql-proxy --proxy-backend-addresses=192.168.1.201:3306 --proxy-backend-addresses=192.168.1.202:3306
						(从服务器ip:port)

					3.连接mysql_proxy:

						mysql -h 'proxy的ip' -p 4040 -u -p

	6）除主从复制外，还有主主复制、环形结构等。

七、表分区
	1）当一张表数据非常多，且非常大（>=10G）时，执行效率就会降低，这时就需要把数据分开在几张表上。

	2)解决：
		A.从业务角度解决（分表）:根据 id%10= 不同的余数，来插入或查询某张表。
		B.通过mysql的分区功能：mysql会根据指定的规则（根据某列的范围来分区，也可以某列对的散点值来分区），把数据放在不同的表文件上，相当于在文件上拆成小块。用户看到的还是一张表。

		>>如，以用户表为例, uid
			uid [1,10)  ---> user partition u0
			uid[10, 20) ---> user partition u1
			uid [20, MAXVALUE] --> user partion u2

			>>>按列范围来分区

				 create table goods (
				 id int,
				 uname char(10)
				 )engine myisam
				 partition by range(id) (
				 partition p1 values less than (10),
				 partition p2 values less than (20),
				 partition p3 values less than MAXVALUE
				 );

		>>如，有一张省份表
				uid pid uname
				1	1	a
				2	2	b
				3	1	c

			>>>按散点值分区

				create table user (
				uid int,
				pid int,
				uname char(10)
				)engine myisam
				partition by list(pid) (
				partition bj values in (1),
				partition ah values in (2),
				partition xb values in (4,5,6)
				);

	3）注意：分区的那个列，只不要为null;分区可以按照表达式的返回值，计算所属区

八、Mysql运维
	1）安全启动服务（服务挂了会自动重启）：

		mysqld_safe --user=mysql &

	2)安全启动时关闭musql:

		mysqladmin -uroot -p123456 shutdown

	3）不知道账号下关闭mysql:

		ps aux|grep mysql|grep pid-file
		kull `cat /var/run/mysqld/mysql.pid
		(上一行结果的进程文件)

	4）恢复授权表(bin目录下执行)：
		mv datadir/mysql /datadir/mysql_old
		mysql_install_db --user=mysql

	5）账号安全：禁止mysql可以直接登录；删除无关账号。

	6）查看授权过程(检查账号、检查权限)：show grants

	7)检测操作权限：是否有权操作某个库/某张表/某个操作
		检测顺序：user表->db表->tables_priv表

	8)授权：

		grant [usage] on *[dbName].*[tableName] to [user]@'[localhost]' identified by '[passwd]'

		常用权限usage:all、drop、alter、create、delete、update、insert、select

		>>grant select,insert,update on nglinux.user to admin@'localhost' 


	9）撤销授权：

		revoke [权限1，权限2...] on *.* from user@'localhost'

		>>revoke insert,update on nglinux.user from admin@'localhost'

	10）锁表与释放

		锁定表：lock tables 表名 read,表名 write

		释放锁：unlock tables

	11）记录日志
		①vi my.cnf配置文件：
			[mysqld_safe]
			log_error = /var/log/mysqld.log
			#记录所有sql语句
			log = allquery.log
			#记录查询慢的sql语句
			log-slow-queries = slow.log
			#慢查询时间
			long_query_time = 0.2 

		注：除非要调查本网站语句查询特点（统计读写比），否则不要轻易打开，影响磁盘速度。

		②二进制日志
			①位置:如，ls /var/lib/mysql | grep bin

			②查看：mysqlbinlog mysql-bin.000001

				# at 1767
				#140104  5:26:27 server id 199  end_log_pos 1857        Query   thread_id=8     exec_time=0     error_code=0
				SET TIMESTAMP=1388784387/*!*/;
				create table tt3 (id int)


			③字段说明：
				#at 1767 本条事件在日志文件中的偏移位置
				#140104  5:26:27 时间戳
				server id 服务器id防止事件无限循环
				end_log_pos 本条事件的结束位置
				Query 事件类型
				thread_id 当时的线程id
				exec_time 执行时间
				error_code 错误码
				set timestamp 时间戳
				statement 语句

			④清理二进制日志(mysql下执行)：reset master

			⑤利用二进制日志恢复数据：
				假设有以下场景:
					2:00 xxx
					3:00-4:00 CURD
					5:00 drop table stu

				恢复过程：
					A.关闭服务器：server mysqld stop
					B.修改my.cnf，添加：skip_networking
					C.复制最新的数据备份文件：cp -a /bak/datadir  /var/lib/mysql
					[此时已恢复到最后一次备份的数据]
					D.查看二进制日志，找到问题语句（drop）
					E.读取问题语句之前的日志，执行恢复：

						mysqlbinlog --stop-position=221(问题语句#at num) mysql-bin.000001 | mysql -uU -pP
						mysqlbinlog --start-position=304(at num) mysql-bin.000001 | mysql -uU -pP

九、sphinx(斯芬克斯)全文搜索引擎
	1)索引与全文索引概念
		索引：查询速度快.
		全文索引：针对文章内容中的单词各做索引

	2）mysql支持全文索引
		①添加fulltxt全文索引:

			alter table news add fulltext index cont(cont);

		②查询操作:

			select id,content from news where match(cont) against('string')

		③总结：A.mysql5.7以上版本支持fulltext全文索引
		       B.全文索引功能不够强大，且无法对中文进行合理的全文索引。
		       C.停止词（出现频率高的单词，如is,are,he...）不予索引。
		       D.我要要对中文做全文索引需要解决2个问题：
		       		a.性能提高，用第三方全文搜索引擎工具，如sphinx,solr等
		       		b.中文分词，如mmseg

	3）Sphinx + mmseg = coreseek
		①linux环境下编译安装：
			A.下载依赖库：

				yum install make gcc gcc-c++ libtool autoconf automake imake libxml2-devel expat-devel

			B.下载sphinx和mmseg源码包并解压(wget + tar -zxvf xxx)

			C.安装mmseg

				cd mmseg
				./bootstrap
				./configure --prefix=/usr/local/mmseg
				make && make install

			D.安装sphinx

				cd sphinx/csft
				./buildconf.sh
				./configure --prefix=/usr/local/sphinx --with-mysql=/usr/local/mysql --with-mmseg --with-mmseg-includes=/usr/local/mmseg/include/mmseg --with-mmseg-libs=/usr/local/mmseg/lib/
				(需要告诉sphinx mysql、mmseg头文件和库文件的路径)
				make && make install

	4）Sphinx使用
		①分三个部分：
			A.数据源：让sphinx知道查哪些数据。
			B.索引配置：针对哪些数据做索引，索引文件在哪些目录等等。
			C.搜索服务器：通过某端口（9312）以自身的协议，与外部程序做交互

		②数据源和索引典型配置
			cd /usr/local/sphinx
			vim etc/sphinx-min.conf

				source news
				{
					type = mysql
					sql_host,sql_user,sql_pass,sql_db,sql_port..

					sql_query_pre = set names utf8;
					sql_query_pre = set session query_cache_type=off
					sql_query = select id,cont from news
					sql_query_info_pre = set names utf8;
					sql_query_info = select * from news where id=$id
				}

				index news
				{
					source = news
					path = /usr/local/sphinx/var/data/news
					docinfo = extern
					charset_dictpath = /usr/local/mmseg/etc
					charset_type = zh_cn.utf-8
				}

			*更多配置说明，请查看：https://blog.csdn.net/moqiang02/article/details/42024383

		③生成索引文件：

			./bin/indexer -c etc/sphinx-min.conf news
			(配置文件中的索引名)

		④查询测试(命令行模式)：

			./bin/search -c etc/sphinx-min.conf <string>

	5）启动Shpinx服务（实现代码模式查询）
		①配置文件vim etc/sphinx-min.conf

			searchd{
				listen = localhost:9312
				pid_file = /usr/local/sphinx/var/log/searchd.pid
				log = /usr/local/sphinx/var/log/test.log
				query_log =/usr/local/sphinx/var/log/test.query.log
				client_timeout = 5
				max_children = 5
				max_matches = 1000
				seamless_rotate = 1
			}

		②启动sphinx服务器：

			./bin/searchd -c etc/sphinx-min.conf

		③客服端连接服务器查询调试:
			A.复制sphinx/api/*.php文件案例至apache或nginx下:

				cp *.php /usr/local/nginx/html/sphinx 

			B.编译php的sphinx扩展

		④简要查询代码：

			<?php
				require ( "sphinxapi.php" );
				$kw = $_GET['kw'];
				$cl = new SphinxClient ();
				$cl->SetServer ( '127.0.0.1', 9312);
				$cl->SetConnectTimeout ( 3 );
				$cl->SetArrayResult ( true );
				$cl->SetMatchMode ( SPH_MATCH_ANY);
				$res = $cl->Query ( '$kw', "*" );
				//print_r($cl);
				print_r($res);
			?>

		⑤增量索引：当你对数据表增添数据后，需要重新生成索引:

			./bin/indexer -c etc/sphinx-min.conf news --rotate

		而索引合并IO代价比全新生成要小，索引合并命令：

			./bin/indexer -c etc/sphinx-min.conf -merge 主索引 增量索引 --rotate

			A.传统方法：创建1张表做主索引已索引行的计数器, 每隔5分钟,生成增量索引,合并到主索引并且把当前最大的id更新到计数器

			B.新方法：
				a.生成主索引,写入计数器
				b.每5分钟,根据计数器,全新生成增量索引
				c.每晚凌晨负载低时,合并主索引+增量索引
				d.每周固定某时间,全新生成总索引

	6）Sphinx其他知识
		①查询语法：查询（查询模块、字段查询）、过滤(属性)、排序（属性或权重）
		②索引合并：增量索引、分布式索引

十、状态监测zabbix
	1)概述：开源监控工具，可以监控ftp,ssh,mysql,apache等服务状态，并可以生成图标，用到SNMP协议

十一、服务器性能测试工具Sysbench
