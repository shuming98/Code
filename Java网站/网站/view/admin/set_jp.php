<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');

$sql = "select count(*) from forum_post where cat_name = '精品' and post_id = $_GET[post_id]";

if(mGetOne($sql)>0){
	echo '已是精品贴';
	exit;
}else{
	$sql2 = "update forum_post set cat_name = '精品' where post_id = $_GET[post_id]";
	$res = mQuery($sql2);
	echo $res?'设置成功':'设置失败';
}
 ?>