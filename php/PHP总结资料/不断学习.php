 项目实战
 1.做需求分析 --> 文字采访和引导需求
 2.整理思想，制作网站功能结构图
 3.制作网站页面原型图
 4.网站数据库建模
 5.代码规范：类大驼峰(ClassName),函数小驼峰(arraySum),写关键注释
 6.文件说明
 	/**
 	 * @author 
 	 * @link
 	 */
 7.组织项目文件

<?php 
ob_start();
header('location:url');    //跳转到url页面 php的
header("refresh:3;url=$url");    //3秒后跳转到url页面 php的
ob_end_flush();


/**
 * @实现登录和退出功能
 */
//登录
session_start();
$_SESSION['name']=$value;

//退出
session_start();
$_SESSION=array();
setcookie("PHPSESSID","",time()-1,'/');
session_destroy();
header('Location:../../index.php');
 ?>

十、简短的小知识
1.$_GET 接收表单method="get"的数据;
  $_POST 接收表单method="post"的数据

2.@XXX  隐藏报错信息

3.$a % $b 取模运算结果正负取决于$a的符号

4.字符串也可以使用 $str[n] / $str{n} 来取某个字符

5.max()函数
	①数值比较，输出最大;
	②数组比较，返回更长的数组;
	③把非数值字符串'hello'当做'0',与0比较,谁作为第一个参数，就输出谁;
	④如果给出字符串、数组、数值比较,则视数组为最大值并输出.

6.''单引号字符串中的内容总被认为是普通字符,可以转义\ '
  ""双引号字符串中的内容能够被解释而且替换

7.switch 语句可以避免冗长的if else代码块，case只能处理整数，break不能少，default处理没有包含到的情况，为了更加安全。

8.中文字符集（支持汉字丰富程度）：
	BIG18030(支持罕见字)>GBK(简中)=BIG5(繁中)>GB2312(支持汉字较少)

9.'01' 与 1 做比较是会被当做整型处理'=='。

10.0、''、false、null 做比较是 == 的
   '0' 与 null 和 '' 做比较并不是 == 的

11.empty('0') 是true
   empty(array(array())) 是false

12.is_null($var) 判断变量是否为NULL，被认为true是有以下三种情况：
	①被赋值为NULL；
	②尚未被赋值；
	③被unset();

13.函数外是全局变量，函数内是局部变量，就算使用 static 且同名函数，也是独立的，除非使用global声明全局。

14.使用全局属性的变量：global $a 或 GLOBALS['a'];

15.修改session的生存时间
	1）将php.ini中的 session.gc_maxlifetime 设置为9999，重启apache
	2）session_save_path('./'); 	//保存路径
	   session_set_cookie_params(24*3600); 	//设置时间
	   session_start();

16.类定义必须在一个PHP块内.

17.类内如何定义常量以及访问？
	1）定义：const PI = 3.14;
	2）访问：类名::常量名