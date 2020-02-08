在CentOS 7使用yum流畅安装LAMP。先安装后配置，第四、第五步不是必要。

一、安装Apache/MariaDB/PHP7

	1.安装Apache服务器
		yum -y install httpd

	2.安装MariaDB数据库
		yum -y install mariadb mariadb-server

	3.安装PHP7.4(安装扩展源epel/remi)
		yum install epel-release
		rpm -ivh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
		yum --enablerepo=remi install php74-php php74-php-fpm php74-php-mysqlnd

二、配置

	1.Apache
		安装后不需要配置。

		link:Apache常见配置

	2.MariaDB
		安装后需要设置密码，方法有如下两种，任选其一：

		1）输入命令：
			mysql_secure_installation

		2）登录数据库后输入：
			set password for root@localhost = password('新密码');

		link：MySQL常见配置
		link：MySQL主从复制与读写分离

	3.PHP7
		安装后不需要配置。

		link:PHP常见配置
		link:PHP安装扩展

三、启动服务

	命令：systemctl start/restart/status/stop [service]

	1.Apache
		systemctl start httpd

	2.MariaDB
		systemctl start mariadb

	3.PHP7
		systemctl start php74-php-fpm

四、防火墙设置
	如果启动服务后外界无法访问或连接，首先考虑防火墙问题。

	服务器要对防火墙进行设置:
	命令:firewall-cmd --permanent --add-port=[port/protocol]

	1.Apache

		firewall-cmd --permanent --add-port=80/tcp
		firewall-cmd --reload
		systemctl restart httpd

	2.MariaDB

		firewall-cmd --permanent --add-port=3306/tcp
		firewall-cmd --reload
		systemctl restart mariadb

五、开机自启动

	命令：systemctl enable/disable [service]

	1.Apache

		systemctl enable httpd

	2.MariaDB/MySQL

		systemctl enable mariadb

	3.PHP7

		systemctl enable php74-php-fpm

六、开发环境测试

	1.输入以下命令确保三个服务已开启，80/3306/9000端口在监听

		netstat -natp

	2.vim /var/www/html/index.php

		<?php phpinfo(); ?>

	3.开启浏览器输入域名或ip,如果能访问则配置成功。