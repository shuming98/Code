<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询所有班级
$sql = "select t_class from teacher group by t_class";
$class = array_column(mGetAll($sql),'t_class');

//查询该老师昵称
$sql2 = "select user_nick from user_data where user_account='$_POST[teacher]'";
$t_name = mGetOne($sql2);

if(in_array($_POST['class'],$class)){
	echo $_POST['class'],'已存在,请重新填写';
	exit;
}else{
	$addclass['user_account'] = $_POST['teacher'];
	$addclass['t_name'] = $t_name;
	$addclass['t_class'] = $_POST['class'];
	$res = mExec('teacher',$addclass);
	echo $res?'添加成功':'添加失败';
}
 ?>
