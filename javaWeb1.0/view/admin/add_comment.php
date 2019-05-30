<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/ue_init.php');

if(!isset($_GET['floor_id'])){
	$comment['user_account'] = $_SESSION['user_account'];
	$comment['post_id'] = $_GET['post_id'];

	//获取楼层
	$sql = "select count(post_id) from forum_comment where post_id = $comment[post_id]";
	$comment['floor_id'] = mGetOne($sql) + 1;

	$comment['content'] = $_POST['content'];

	$res = mExec('forum_comment',$comment);
	echo $res?'回复成功':'回复失败';
}else{
	$reply['user_account'] = $_SESSION['user_account'];
	$reply['post_id'] = $_GET['post_id'];
	$reply['floor_id'] = $_GET['floor_id'];
	$reply['content'] = $_POST['content'];

	$res = mExec('forum_reply',$reply);
	echo $res?'回复成功':'回复失败';
} ?>
