1.没有网络
可以使用ip addr命令查看，和使用nmtui命令对网络进行图形配置
在最小版centos里，如果你想使用ifconfig 命令，需要安装net-tools。

2.apache开启服务后，外界无法访问
可以直接执行以下两条命令：
    setenforce 0
    systemctl stop firewalld
