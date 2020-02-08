因操作系统和软件版本不同，内容可能会有出入。
一、PHP目录

	根目录：/opt/remi/php74/root/
	配置文件：/etc/opt/remi/php74/php.ini
	扩展配置：/etc/opt/remi/php74/php.d
	命令文件:/usr/bin/php74

二、常见配置

>>服务器Apache/Nginx

#编辑php目录下/php-fpm.d/www.conf文件
#你选用那个服务器，就修改user和group为apache/nginx
user = apache
group = apache

>>资源限制

#脚本最大执行时间(s),防止写得不好的脚本占用系统资源。仅影响本身运行时间，函数调用等其他功能不包括在内。
max_execution_time = 30

#脚本解析输入数据允许的最大时间(s)，接受数据到执行的过程。
max_input_time = 60

#脚本可能消耗的最大内存量
memory_limit = 128M

>>数据处理

#允许POST数据最大字节长度。此设定影响文件上传，如果上传大文件，此值必须大于upload_max_filesize的值。如果启动内存限制，该值应小于memory_limit的值。
post_max_size = 8M 

>>文件上传

#是否允许HTTP文件上传，不能为Off.
file_uploads = On

#文件上传时存放的临时目录(必须是PHP进程用户可写的目录)。如果未指定使用系统默认的临时目录。
upload_tmp_dir = 

#允许上传的文件的最大尺寸
upload_max_filesize = 2M

#允许同时上传的文件的最大数量
max_file_uploads = 20 

>>Fopen封装

#激活URL形式的fopen封装协议，可以访问URL对象，比如文件。
allow_url_fopen = On

#允许include,require使用URL识别fopen封装
allow_url_include = Off

#socket默认超时时间(s)
default_socket_timeout = 60

>>日期

#日期函数使用的默认时区
date.timezone = PRC

>>session

#是否使用严格的会话ID模式
session.use_strict_mode = 0

#是否在客户端用cookie来存放会话ID
session.use_cookies = 1

#是否通过安全连接发送cookie
session.cookie_secure = Off

#是否在客户端仅使用cookie来存放会话。启用后可以防止通过URL传递会话ID的攻击
session.use_only_cookies = 1

#cookie的会话名
session.name = PHPSESSID

#是否在请求开始时自动启动一个会话
session.auto_start = 0

#定义序列化/解序列化的处理器名字。可以使用 php_serialize 避免脚本退出时，数字和特殊字符索引导致出错。
session.serialize_handler = php

#每个会话初始化时启动gc（garbage collection 垃圾回收）进程的概率。例如 1/100 意味着在每个请求中有 1% 的概率启动 gc 进程。
session.gc_probability = 1

#超过多少秒后数据会被视为垃圾并被清除
session.gc_maxlifetime = 1440

>>错误信息

#设置错误报告级别，可通过error_reporting()函数设置。开发阶段启用E_NOTICEC和E_STRICT能方便调试和改善编码。
error_reporting = E_ALL

#是否将错误信息输出到屏幕。这是一个辅助开发的功能，但不要在生产系统中使用（例如系统被连接到互联网对外提供服务)。
display_errors = off

#是否将脚本运行的错误信息记录到日志中
log_errors = On

#错误日志的最大字节数，设置为0表示不限长度。
log_error_max_len = 1024


>>其它

#是否允许使用PHP代码开始标志的缩写形式
开启后，<?php echo $var; ?> ----- <?=$var?>
short_open_tag = off

#浮点数中显示的有效数字的位数
precision = 14

三、开启Opcache-提高PHP性能

1.首先你要先确保你已经安装了Opcache扩展并开启了此模块。

#开启Opcache扩展
opcache.enable = 1 

#支持CLI版本的PHP启动操作码缓存，一般用于测试和调试
opcache.enable_cli = 1

#设置共享内存大小(M)
opcache.memory_consumption=128

#字符串缓存大小
opcache.interned_strings_buffer=8

#最大缓存文件数量
opcache.max_accelerated_files=4000

#允许占用内存的最大百分比，超过此限制会重启进程
opcache.max_wasted_percentage = 20

#启动文件缓存时间戳
opcache.validate_timestamps = 1

#文件检测周期
opcache.revalidate_freq=60

#出现异常后立即释放全部内存
opcache.fast_shutdown=1


2.补充

    1）Opcache是什么？
    Opcache是将PHP脚本预编译的字节码（Operate Code，也称操作码）存放在共享内存中。

    2）开启Opcache目的：避免重复编译，减少CPU和内存开销。

    3）开启Opcache后：PHP会直接从共享内存中获取字节码后直接执行，中间的三个步骤会省略掉，因此会大幅提高PHP代码执行效率。

3.注意事项

    1）不建议在开发过程中开启Opcache。
    开启后，开发人员修改的内容不会立即显示和生效。应当在性能测试时开启，在生产环境中使用需经过严格测试。
    2）Opcache指标设置不应太大
    应当结合项目实际情况需求及Opcache官方建议进行配置。
    3）不要长期使用旧版本
    应当关注官方动态，了解bug修复和功能优化并及时更新。
    4）不建议和其余的PHP优化器一起使用
    Opcache是一个很好的选择。使用太多优化器会降低缓存命中数，增加系统开销。


更多请参考：https://www.cnblogs.com/cuchadanfan/p/6163970.html
