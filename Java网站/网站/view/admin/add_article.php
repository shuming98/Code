<?php 
session_start();
require('../../lib/ue_init.php');
$article['user_account'] = $_SESSION['user_account'];
$article['dirname'] = $_POST['dirname'];
$article['art_title'] = $_POST['art_title'];
$article['art_content'] = $_POST['content'];


if($article['dirname']=='default' && $_GET['art_id']!=6){
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
