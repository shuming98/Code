<?php 
session_start();
require('../../lib/init.php');

//删除用户数据
if(isset($_GET['account'])){
	$sql = "delete from user where user_account='$_GET[account]'";
	$sql2 = "delete from user_data where user_account='$_GET[account]'";
	$res = mQuery($sql);
	$res2 = mQuery($sql2);
	echo ($res && $res2)?'删除成功':'删除失败';
}
 ?>
