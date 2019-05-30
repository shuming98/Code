<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//更改学生班级
if(isset($_GET['opclass'])){
	$sql =	"update user_data set class='$_POST[class]' where user_account='$_GET[opclass]'";
	$res = mQuery($sql);
	echo $res?'修改成功':'修改失败';
}

//修改资源标签名
if(isset($_GET['optag'])){
	$sql = "update resource_tag set tag_name='$_POST[tagname]' where tag_id=$_GET[optag]";
	$res = mQuery($sql);
	echo $res?'修改成功':'修改失败';
}

//修改目录名
if(isset($_GET['opdir'])){
	$sql = "update study_dir set dirname='$_POST[dirname]' where dirname_id=$_GET[opdir]";
	$res = mQuery($sql);
	echo $res?'修改成功':'修改失败';
}

//修改模块名
if(isset($_GET['opcat'])){
	$sql = "update news_cat set cat_name='$_POST[catname]' where id=$_GET[opcat]";
	$res = mQuery($sql);
	echo $res?'修改成功':'修改失败';
}
 ?>
