<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

if(isset($_GET['com_id'])){
	//删除楼层回复
	$sql = "delete from forum_reply where com_id = $_GET[com_id]";
	mQuery($sql);
	echo '删除成功';
	exit;
}else{
	//删除一贴某楼下所有回复
	$sql = "update forum_comment set content='' where post_id = $_GET[post_id] and floor_id = $_GET[floor_id]";
	mQuery($sql);

	$sql2 = "delete from forum_reply where post_id = $_GET[post_id] and floor_id = $_GET[floor_id]";
	mQuery($sql2);

	echo '删除成功';
}
?>