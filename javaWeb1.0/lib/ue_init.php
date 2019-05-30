<?php 
/**
 * php初始化文件,每个php文件开头引入
 */

//header('Content-type:text/html;charset=utf-8');
define('ROOT',dirname(__DIR__));
//进行了两次dirname,返回的绝对路径最后没有'/';
require(ROOT . '/lib/mysql.php');	
require(ROOT . '/lib/function.php');
 ?>