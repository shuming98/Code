<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/ue_init.php');

$news['title'] = $_POST['title'];
$news['content'] = $_POST['content'];
$news['cat_id'] = $_POST['news_id'];

if($news['cat_id'] == 'default'){
	echo 0;
	exit;
}

if(isset($_GET['id'])){
	$res = mExec('home_news',$news,'update',"id=$_GET[id]");
	echo $res?'修改成功':'修改失败';
}
 ?>