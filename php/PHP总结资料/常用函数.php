<?php 
一、常用函数
isset(var)	//判断是否已设置
empty(var)	//判断是否为空，如0，null,false,"",array()
rand(min,max) //生成随机数
md5(string)	//md5字符串
md5_file(filename) //md5文件
getenv(varname) //获得环境变量值 phpinfo()/$_SERVER查看环境变量列表
http_build_query($_GET) //向url追加参数 $_GET['page']=1;

二、字符串函数
strlen(string)	//获取字符串长度
strrev(string)	//反转字符串
strtoupper(string)	//字符串转大写
strtolower(string)	//字符串转小写
stripos(string,char)	//查找某字符首次出现位置，返回char*
strrchr(string,char) //查找某字符最后一次出现位置，返回char*
str_shuffle(string) //随机打乱一个字符串
str_replace(search,replace,subject)
substr(string,startnum,endnum) //返回字符串的子串,从左边0开始,右边从-1开始
trim(string)	//去除字符串空白字符
rtrim(string)	//去除字符串末端空白字符
ltrim(string)	//去除字符串开头空白字符
str_split(string,length)	//字符串转数组

三、时间日期函数
date(format,timestamp) //格式化一个时间。format['Y-m-d H:m:s']
time()	//返回当前时间戳
strtotime('datatime/now/+1 day')	//任意日期转化为unix时间戳
checkdate(month,day,year)	//验证一个日期是否有效math,....../array

四、文件函数
is_dir(filename) //判断是否为一个目录
mkdir(pathname,0777,true) //递归创建目录
move_uploaded_file(filename, destination) //上传文件到指定路径

五、数学函数
ceil(math) //进一取整
max(math,....../array)	//返回最大值
min(math,....../array)	//返回最小值
intval(math,base) //向下取整,base进制

六、mysqli函数
mysqli_connect(conn,host,passwd,database);
mysqli_query(conn,sql);
mysqli_fetch_assoc(res)	//关联数组形式返回查询结果
mysqli_fetch_row(res)	//取得一行作为枚举数组 [0]返回一个结果

七、数组函数
implode(glue,array)		//数组转化为字符串,glue拼接
array_keys(array,search_value)	//返回数组中部分或全部键名
array_values(array)		//返回数组中所有的值
array_column(array,column_key)	//返回数组中指定的一列
array_shift(array)	//移除数组开头元素


?>
