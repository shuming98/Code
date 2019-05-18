<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');
$sql = "select count(*) from resource_tag where user_account = '$_SESSION[user_account]'";
if(mgetOne($sql)<5){
	$resource_tag['tag_name'] = $_POST['tag_name'];
	$resource_tag['user_account'] = $_SESSION['user_account'];
	$res = mExec('resource_tag',$resource_tag);
	echo $res?'添加成功':'添加失败';
}else{
	echo '标签已超过5个';
}
 ?>
