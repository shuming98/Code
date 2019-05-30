<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/ue_init.php');
$article['user_account'] = $_SESSION['user_account'];
$article['dirname_id'] = $_POST['dirname'];
$article['art_title'] = $_POST['art_title'];
$article['art_content'] = $_POST['content'];

$sql = "select art_id from article where dirname_id=0 and user_account='$_SESSION[user_account]'";
$art_id = mGetOne($sql);

$sql2 = "select count(*) from article where dirname_id=0 and user_account='$_SESSION[user_account]'";

$default_num = mGetOne($sql2);

if($article['dirname_id']==0 && ($_GET['art_id']!=$art_id && $default_num!=0)){
		echo 0;
		exit;
}

if(isset($_GET['art_id'])){
	$res = mExec('article',$article,'update',"art_id=$_GET[art_id]");
	echo $res?'修改成功':'修改失败';
}else{
	$res = mExec('article',$article);
	echo $res?'发布成功':'发布失败';
}
 ?>
