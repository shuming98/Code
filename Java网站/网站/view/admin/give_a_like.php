<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

$sql = "select count(*) from give_a_like where post_id=$_GET[post_id] and user_account='$_SESSION[user_account]'";

if(mGetOne($sql)>0){
	echo '已点赞';
	exit;
}else{
	$like['post_id'] = $_GET['post_id'];
	$like['user_account'] = $_SESSION['user_account'];	

	$res = mExec('give_a_like',$like);
	echo $res?'点赞+1':'点赞';
}

 ?>