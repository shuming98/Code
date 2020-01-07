<?php 
require('../../lib/init.php');

$user['user_account']=trim($_POST['user_account']);
$user['user_password']=md5Code(trim($_POST['user_password']));

$sql = "select user.user_account,permission_id from user inner join user_data on user.user_account=user_data.user_account where user.user_account = '$user[user_account]' and user_password = '$user[user_password]'";
$row = mGetRow($sql);
if($row){
	session_start();
	$_SESSION['user_account'] = $row['user_account'];
	$_SESSION['permission_id'] = $row['permission_id'];

	//记录登录时间
	$date = date("Y-m-d H:i:s");
	$sql2 = "update user set lastlogin='$date' where user_account='$user[user_account]'";
	mQuery($sql2);

	//是否记住用户名密码
	if($_POST['remember']=='on'){
			setcookie('account',$user['user_account'],time()+86400,'/');
		}else{
			setcookie('account',$user['user_account'],time()-3600,'/');
		}
		header('Location:../../index.php');
}else{
	echo "<script>alert('账号或密码错误!');</script>";
	echo "<script>location.href='../../index.php';</script>";
}
 ?>

