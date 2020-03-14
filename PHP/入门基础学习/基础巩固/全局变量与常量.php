<?php 
一、超级全局变量(以数组形式展现)
$_GET   从地址栏上获取变量
$_POST  传递变量，发送数据
$_COOKIE 通过HTTP Cookies方式传递变量
$_REQUEST 默认情况下包含了$_GET,$_POST 和 $_COOKIE 的数组。
$_SESSION  参见Session函数
$_FILES   通过HTTP POST方式上传数组
$_ENV    通过环境方式传递变量
$_SERVER 包含头信息、路径、脚本位置等信息的数组(服务器提供)
$_GLOBALS 引用全局变量

/*
其它的一些获取用户的信息：
获取系统类型及版本号：    php_uname()  (例：Windows NT COMPUTER 5.1 build 2600)
只获取系统类型：          php_uname('s')      (或：PHP_OS，例：Windows NT)
只获取系统版本号：        php_uname('r')         (例：5.1)
获取PHP运行方式：         php_sapi_name()        (PHP run mode：apache2handler)
获取前进程用户名：        Get_Current_User()
获取PHP版本：             PHP_VERSION
获取Zend版本：            Zend_Version()
获取PHP安装路径：         DEFAULT_INCLUDE_PATH
获取当前文件绝对路径：    __FILE__
获取Http请求中Host值：    $_SERVER["HTTP_HOST"]           (返回值为域名或IP)
获取服务器IP：            GetHostByName($_SERVER['SERVER_NAME'])
接受请求的服务器IP：      $_SERVER["SERVER_ADDR"]     (有时候获取不到，推荐用：GetHostByName($_SERVER['SERVER_NAME']))
获取客户端IP：            $_SERVER['REMOTE_ADDR']
获取服务器解译引擎：      $_SERVER['SERVER_SOFTWARE']
获取服务器CPU数量：       $_SERVER['PROCESSOR_IDENTIFIER']
获取服务器系统目录：      $_SERVER['SystemRoot']
获取服务器域名：          $_SERVER['SERVER_NAME']  (建议使用：$_SERVER["HTTP_HOST"])
获取用户域名：            $_SERVER['USERDOMAIN']
获取服务器语言：          $_SERVER['HTTP_ACCEPT_LANGUAGE']
获取服务器Web端口：       $_SERVER['SERVER_PORT']
访问用户的浏览器信息：  $_SERVER['HTTP_USER_AGENT']; 
<script language="JavaScript">
document.write("浏览器名称: "+navigator.appName+"<br>");
document.write("浏览器版本号: "+navigator.appVersion+"<br>");
document.write("系统语言: "+navigator.systemLanguage+"<br>");
document.write("系统平台: "+navigator.platform+"<br>");
document.write("浏览器是否支持cookie: "+navigator.cookieEnabled+"<br>");
</script>
*/

二、常量(声明后不能修改及销毁，全局有效，命名习惯上全大写,不需加$)
define(name,value)    声明常量       define('NAME',3.14/p/null/array(a,b,c))
defined(常量名)        检验常量是否存在
echo constant(常量名)       输出常量值
//开发一般这样用
if(!defined('A')){
	define('A',a);
}
echo constant('A');
 ?>
