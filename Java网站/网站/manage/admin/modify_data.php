<?php 
session_start();
require('../../lib/init.php');

//更改学生班级
if(isset($_GET['opclass'])){
	$sql =	"update user_data set class='$_POST[class]' where user_account='$_GET[opclass]'";
	$res = mQuery($sql);
	echo $res?'修改成功':'修改失败';
}
 ?>
