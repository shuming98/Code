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
		header('Location:../../home.php');
	}else{
		echo "<script>alert('账号或密码错误!');</script>";
		echo "<script>history.go(-1);</script>";
	}
 ?>

