网站环境：Apache/Nginx + Mysql + PHP5/PHP7

必须配置：

1.文件上传位置：ueditor 和 upload 这两个目录的“其它人”必须有读写执行权限。
例如，Unix环境下，设置chmod -R 777 ueditor upload

2.修改/lib/config.php里的数据库配置
'user'=>'数据库用户'
'passwd'=>'数据库密码'
'db'=>'库名'

2.php.ini
①修改 upload_max_filesize = 100M 和 post_max_size = 100M (允许上传多大文件)
②修改date.timezone = PRC
③修改 allow_url_fopen = Off 和 allow_url_include = Off (网站安全)
④删掉注释 extension = php_mysqli.dll


3.httpd.conf
①删掉注释(#) LoadModule php7_module (php5_module)

4.my.cnf (my.ini)
①sql_mode = “************” 删除其中的“only_full_group_by”

5.引入初始化数据库
mysql -u root -p < java_web.sql (文件在/lib目录下)

6.网站初始账号密码：
账号：root
密码：java2019
