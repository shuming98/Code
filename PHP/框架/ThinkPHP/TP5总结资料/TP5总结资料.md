一、创建项目：composer create-project topthink/think=5.1.* tp5

二、配置文件：复制一份.example.env -> .env 并进行数据库，debug调试配置。

三、多模块实现(一个是前台模块，一个是后台模块)
1.app.php配置文件开启：'app_multi_module'=> true
2.复制index文件命名为admin。
3.控制器等命令空间修改为如下：
"namespace app\index\controller;"改为 "namespace app\admin\controller;"
4.路由新建文件：admin.php

四、/public/static文件

    用于存放css/js/images等文件资源，引入时填写绝对路径：/static/index/css/xxx.css