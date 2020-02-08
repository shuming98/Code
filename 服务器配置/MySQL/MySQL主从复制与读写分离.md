一、主从复制

    1.主从原理:从服务器读取主服务器的binlog,并转换为自身可执行的relaylog,过程如下：

        1）主：开启binlog（二进制日志功能） , 从：开启relaylog
        2）主：设置从账号权限（授予读binlog权限），从：利用账号，连接主服务器
        3）主：start , 从：start slave

    2.主从表现：

        1）服务端角度：N台从服务器和主从服务器保持数据一致，也就是说读服务器(从)是写服务器(主)的数据镜像。
        2）客户端角度：要区分读/写语句，并且分别请求从/主服务器。



    3.具体实施

        主从配置过程，除配置文件外，命令皆在mysql内执行。
        准备：两台服务器以上。

        1）主服务器开启binlog, 从服务器开启relaylog

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

        2）主服务器创建从服务器复制账号权限，从服务器连接主服务器

            A.主服务器创建复制账号
                grant replication slave,replication client on *.* to repl@'192.168.1.%' identified by 'repl';
                flush privileges;(刷新权限)

            B.从服务器连接主服务器
                change master to
                master_host='192.168.1.249',（主服务器ip）
                master_user='repl',
                master_password='repl',(复制账号用户名和密码)
                master_log_file='mysql-bin.000001',
                master_log_pos=619;
                (最后两行主服务器在mysql输入'show master status'命令查看)

        3）从服务器开启slave:start slave

    4.常用语句
        1）查看主服务器状态（尤其日志及位置）：show master status
        2）查看从服务器状态：show slave status
        3）开启/重置/暂停slave状态：start/reset/stop slave

    5.日志格式
        1）statement:抄语句；
        2）row:抄结果，直接复制磁盘上的新增变化；
        3）mixed:前两种混合，使用它，系统会自动判断。

二、读写分离与中间件

    1.目的：master主服务器执行insert,update,delete操作；slave从服务器执行select操作。

    2.实现
        1）修改mysql类

            class mysql{
                $dbm = 主服务器；
                $dbs1 = 从服务器；

                public function query(){
                    在query里面进行语句判断，分别连接不同的mysql服务器
                }
            }

       2）使用中间件（不需要修改mysql类情况下，在中间弄一个mysql_proxy负责路由选择）
            A.官方集群中间件：mysql_proxy
            B.国产中间件：amoeba

            C.mysql_proxy中间件如何实现负载均衡和读写分离？

               a.下载安装并解压：

                    http://mysql.cdpa.nsysu.edu.tw/Downloads/MySQL-Proxy/mysql-proxy-0.8.4-linux-glibc2.3-x86-64bit.tar.gz

                b.执行mysql_proxy:

                    ./mysql-proxy-path/bin/mysql-proxy --proxy-backend-addresses=192.168.1.201:3306 --proxy-backend-addresses=192.168.1.202:3306
                    (从服务器ip:port)

                c.连接mysql_proxy:

                    mysql -h 'proxy的ip' -p 4040 -u -p


三.除主从复制外，还有主主复制、环形结构等。