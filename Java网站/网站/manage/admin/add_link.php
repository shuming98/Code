<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

$news['title'] = $_POST['title'];
$news['link'] = $_POST['link'];
$news['cat_id'] = $_POST['news_id'];

if($news['cat_id'] == 'default'){
	echo 0;
	exit;
}

$res = mExec('home_news',$news);
echo $res?'引入成功':'引入失败';
?>