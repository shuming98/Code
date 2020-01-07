<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');

$work['user_account'] = $_SESSION['user_account'];
$work['class'] = $_POST['class'];
$work['work_title'] = $_POST['work_title'];
$work['work_content'] = htmlspecialchars($_POST['work_content'],ENT_QUOTES);
$work['deadline'] = $_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD'].' 23:59:59';

//将文件路径导入数据库
if(!($_FILES['work']['name'] == '') && ($_FILES['work']['error'] == 0)){
	$filename = createWorkDir() . '/' . $_FILES['work']['name'];
	if(move_uploaded_file($_FILES['work']['tmp_name'],ROOT . $filename)){
		$work['work_filepath'] = $filename;
	}
}

$res = mExec('issue_work',$work);
echo $res?'发布作业成功':'发布作业失败';


function createWorkDir(){
	$path = '/upload/issue_work/'.$_POST['class'].'/'.date('Y/m/d');
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	}else{
		return false;
 	}
}
 ?>