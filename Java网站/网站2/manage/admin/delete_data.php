<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//删除用户数据
if(isset($_GET['account'])){
	$sql = "delete from user where user_account='$_GET[account]'";
	$sql2 = "delete from user_data where user_account='$_GET[account]'";
	$res = mQuery($sql);
	$res2 = mQuery($sql2);
	echo ($res && $res2)?'删除成功':'删除失败';
}

//删除班级数据
if(isset($_GET['class'])){
	$sql = "delete from teacher where t_class='$_GET[class]'";
	$res = mQuery($sql);
	echo $res?'删除成功':'删除失败';
}

//删除资源分类数据
if(isset($_GET['tag'])){
	$sql = "delete from resource_tag where tag_id=$_GET[tag]";
	$res = mQuery($sql);

	$sql2 = "delete from resource where tag_id=$_GET[tag]";
	$res2 = mQuery($sql2);
	
	echo ($res && $res2)?'删除成功':'删除失败';
}

//删除课程资源数据
if(isset($_GET['resource'])){
	$sql = "delete from resource where resource_id=$_GET[resource]";
	$res = mQuery($sql);
	echo $res?'删除成功':'删除失败';
}

//删除目录数据
if(isset($_GET['dir'])){
	$sql = "delete from study_dir where dirname_id=$_GET[dir]";
	
	$sql2 = "delete from article where dirname_id=$_GET[dir]";
	
	$res = mQuery($sql);
	$res2 = mQuery($sql2);
	echo ($res && $res2)?'删除成功':'删除失败';
}

//删除文章数据
if(isset($_GET['article'])){
	$sql = "delete from article where art_id=$_GET[article]";
	$res = mQuery($sql);
	echo $res?'删除成功':'删除失败';
}

//删除作业发布数据
if(isset($_GET['work'])){
	$sql = "delete from issue_work where work_id=$_GET[work]";
	$sql2 = "delete from submit_work where work_id=$_GET[work]";
	$res = mQuery($sql);
	$res2 = mQuery($sql2);
	echo ($res && $res2)?'删除成功':'删除失败';
}

//删除资讯数据
if(isset($_GET['news'])){
	$sql = "delete from home_news where id=$_GET[news]";
	$res = mQuery($sql);
	echo $res?'删除成功':'删除失败';
}
 ?>
