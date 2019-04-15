<?php 
session_start();
//echo $_SESSION['user_account']; //user_account teacher
require('../../lib/init.php');

//用户头像上传路径导入数据库
if(!($_FILES['pic_path']['name'] == '') && ($_FILES['pic_path']['error'] == 0)){
	$filename = createUserPicDir() . '/' . randStr() . getExt($_FILES['pic_path']['name']);
	if(move_uploaded_file($_FILES['pic_path']['tmp_name'],ROOT . $filename)){
		$user_data['pic_path'] = $filename;
	}
}

if(!empty($_POST['user_nick'])){
	$user_data['user_nick']	 = $_POST['user_nick'];
}
if(!empty($_POST['gender'])){
	$user_data['gender'] = $_POST['gender'];
}
if(!empty($_POST['tel'])){
	$user_data['tel'] = $_POST['tel'];
}
if(!empty($_POST['class'])){
	$user_data['class'] = $_POST['class'];
}
if(!empty($_POST['teacher'])){
	$user_data['teacher'] = $_POST['teacher'];
}


mExec('user_data',$user_data,'update',"user_account='$_SESSION[user_account]'");

echo '<script>location.replace(document.referrer);</script>'


 ?>