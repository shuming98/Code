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

$_GET 接收表单method="get"的数据
$_POST 接收表单method="post"的数据

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

