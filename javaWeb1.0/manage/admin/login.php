<?php 
require('../../lib/init.php');


$admin['account'] = trim($_POST['account']);
$admin['password'] = md5Code(trim($_POST['password']));


$sql = "select user_account,permission_id from user where user_account='$admin[account]' and user_password='$admin[password]' and permission_id=1";

$row = mGetRow($sql);
if($row){
	session_start();
	$_SESSION['account'] = $row['user_account'];
	$_SESSION['permission'] = $row['permission_id'];
	header('Location:../front/home.php');
}else{
	echo "<script>alert('账号或密码错误!');history.go(-1);</script>";
}
?>
