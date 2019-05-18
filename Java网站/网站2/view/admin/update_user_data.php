<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//用户头像上传路径导入数据库
if(!($_FILES['pic_path']['name'] == '') && ($_FILES['pic_path']['error'] == 0)){
	//删除原图片
	$sql = "select pic_path from user_data where user_account='$_SESSION[user_account]'";
	if(mGetOne($sql) != '/images/icon/user.png'){
		unlink(ROOT . mGetOne($sql));
	}
	//更新图片
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


mExec('user_data',$user_data,'update',"user_account='$_SESSION[user_account]'");

echo '<script>location.replace(document.referrer);</script>'
 ?>