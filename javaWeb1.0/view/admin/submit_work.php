<?php
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//查询用户昵称
$sql = "select user_nick from user_data where user_account = '$_SESSION[user_account]'";
$user_nick = mGetOne($sql);

$work['work_id'] = $_GET['work_id'];
$work['user_account'] = $_SESSION['user_account'];
$work['work_content'] = htmlspecialchars($_POST['work_content'],ENT_QUOTES);



//将文件路径导入数据库
if(!($_FILES['work']['name'] == '') && ($_FILES['work']['error'] == 0)){
	$filename = createSubmitDir() . '/' . $_SESSION['user_account'] . '_' . $user_nick . getExt($_FILES['work']['name']);
	if(move_uploaded_file($_FILES['work']['tmp_name'],ROOT . $filename)){
		$work['work_filepath'] = $filename;
	}
}

//查询是否已提交过作业
$sql2 = "select count(*) from submit_work where work_id=$_GET[work_id] and user_account='$_SESSION[user_account]'";
if(mGetOne($sql2) != 0){
	$sql3 = "select work_filepath from submit_work where work_id=$_GET[work_id] and user_account='$_SESSION[user_account]'";
	unlink(ROOT . mGetOne($sql3));
	$sql4 = "delete from submit_work where work_id=$_GET[work_id] and user_account='$_SESSION[user_account]'";
	mQuery($sql4);
	$res = mExec('submit_work',$work);
	echo $res?'作业修改成功':'作业修改失败';
}else{
	$res = mExec('submit_work',$work);
	echo $res?'作业提交成功':'作业提交失败';
}

//创建文件存储目录
function createSubmitDir(){
	//查询该用户班级
	$sql = "select class from user_data where user_account='$_SESSION[user_account]'";
	$class = mGetOne($sql);

	//查询作业发布时间
	$sql2 = "select issue_date from issue_work where work_id=$_GET[work_id]";
	$issue_date = mGetOne($sql2);

	$path = '/upload/submit_work/'.$class.'/'.date('Y/m/d',strtotime($issue_date)).'/'.$_GET['work_id'];
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	}else{
		return false;
 	}
}

 ?>