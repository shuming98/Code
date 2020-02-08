因操作系统和软件版本不同，内容可能会有出入。
一、MariaDB目录

	配置文件：/etc/my.cnf
	额外配置：/etc/my.cnf.d
	数据库目录：/var/lib/mysql
	日志目录：/var/log/mariadb
	命令文件：/usr/bin/mysql

二、常见配置

[client]（client.cnf文件）
default-character-set = utf8

#端口
port = 3306


[mysql]（mysql-clients.cnf文件）
default-character-set = utf8


[mysqld]（server.cnf文件）
#设置数据库服务器默认编码 utf-8
character-set-server = utf8

#最大连接数
max_connections = 512

#存入堆栈中的请求数
back_log = 512

#数据库安装目录
basedir = /usr/local/mysql

#数据库目录
datadir = /var/lib/mysql

#mysql进程文件，可指定自己的进程文件
pid-file = /var/run/mysqld/mysqld.pid

#错误日志文件
log-error = /data/log/mysqld.log

>>数据库引擎相关参数

#事务获取锁的最长等待时间，超时请求失败
innodb_lock_wait_timeout = 120

#适当增加可提高命中率，参考公式：（总物理内存 - 系统运行所用 - connection 所用）* 90%
innodb_buffer_pool_size = 1024M

#默认值1 每次提交日志记录磁盘 2 日志写入系统缓存 0 不提交也记录
innodb_flush_log_at_trx_commit = 2

#以循环方式将日志文件写到多个文件，默认2
innodb_log_files_in_group = 2

#数据日志文件大小，较大可提升性能，
innodb_log_file_size = 4G

#日志文件所用的内存大小，以M为单位。缓冲区更大能提高性能
innodb_log_buffer_size = 512M

#事务隔离级别
transaction_isolation = REPEATABLE-READ

#查询生成的临时表大小
tmp_table_size = 32M

>>主从复制相关--必须开启log-bin

#主从复制必须，并且各服务器具有唯一性
server-id = 19911216

#配置从服务器的更新是否写入二进制日志，默认是不打开的
log_slave_updates = ON

#主从复制默认忽略的数据库,可用","分隔
replicate-ignore-db = mysql

#主从复制指定数据库,","号隔开
replicate-do-db=qrs,login

>>mysql内存配置参数

#排序缓冲区大小
sort_buffer_size = 256K
#关联查询缓冲区大小
join_buffer_size=256K

#限制Innodb能打开的表的个数
innodb_open_files=65535

#服务器关闭非交互连接之前等待活动的秒数
wait_timeout = 600

#InnoDB事务在被回滚之前可以等待一个锁定的超时秒数
innodb_lock_wait_timeout = 10



[mysqldump]
quick
max_allowed_packet = 32M

三、MySQL配置UTF-8字符集

[mysqld]
character-set-server=utf8
init_connect='SET collation_connection = utf8_unicode_ci'
init_connect='SET NAMES utf8'
collation-server=utf8_unicode_ci
skip-character-set-client-handshake

[client]
default-character-set=utf8

[mysql]
default-character-set=utf8

登录mysql 后通过以下命令查看：

    show variables like "%character%";
    show variables like "%collation%";


四、MySQL优化配置

#单独数据库服务器,可设置为物理内存的70%
innodb_buffer_pool_size = 1024M

#确保写操作快速而可靠并且在崩溃时恢复
innodb_log_file_size = 4G

#扩大连接数
max_connections = 512

#每张表的数据单独放在一个.ibd文件,便于数据压缩
innodb_file_per_table = on

#关注数据安全时设置为1，磁盘读写慢设置为2
innodb_flush_log_at_trx_commit = 1

#有RAID、备份、断电保护可以设置为此
innodb_flush_method = O_DIRECT

#为尚未执行的事务分配的缓存
innodb_log_buffer_size = 1MB

#关闭DNS查找，加快连接速度。开启grant语句只能用ip地址。
skip_name_resolve = ON

#为每个session 分配的内存。事务小设置为1M，事务大设置为4M
binlog_cache_size = 1M

#不做磁盘同步刷新，设置为n是指进行n次事务提交后磁盘刷新，但性能损耗大
sync_binlog = 0

#缓存.frm文件的数量
Open_table_definitions = 403

#操纵内存使用量
table_definition_cache = 1024

#表高速缓存的大小
table_open_cache = 1024

#缓存表的数量
open_tables = 3
