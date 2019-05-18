<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/ue_init.php');
$post['user_account'] = $_SESSION['user_account'];
$post['post_title'] = $_POST['post_title'];
$post['cat_name'] = $_POST['cat_name'];
$post['post_content'] = $_POST['content'];


if(isset($_GET['post_id'])){
	$res = mExec('forum_post',$post,'update',"post_id=$_GET[post_id]");
	$sql = "update forum_post set pubtime=current_timestamp where post_id=$_GET[post_id]";
	mQuery($sql);
	echo $res?'修改成功':'修改失败';
}else{
	$res = mExec('forum_post',$post);
	echo $res?'发布成功':'发布失败';
}
 ?>
