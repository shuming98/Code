<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询已存在账号
$sql = "select user_account from user";
$arr = array_column(mGetAll($sql),'user_account');

//添加管理员账号
if($_GET['pid'] == 1){
	if(in_array($_POST['account'],$arr)){
		echo $_POST['account'],'账号已存在,请重新填写';
		exit;
	}else{
		$admin['user_account'] = $_POST['account'];
		$admin['user_password'] = md5Code($_POST['password']);
		$admin['permission_id'] = 1;

		$admin_data['user_account'] = $_POST['account'];
		$admin_data['user_nick'] = $_POST['nick'];

		$res = mExec('user',$admin);
		$res2 = mExec('user_data',$admin_data);
		echo ($res && res2)?'添加成功':'添加失败';
	}
}

//添加教师账号
if($_GET['pid'] == 2){
	if(in_array($_POST['account'],$arr)){
		echo $_POST['account'],'账号已存在,请重新填写';
		exit;
	}else{
		$teacher['user_account'] = $_POST['account'];
		$teacher['user_password'] = md5Code($_POST['password']);
		$teacher['permission_id'] = 2;

		$teacher_data['user_account'] = $_POST['account'];
		$teacher_data['user_nick'] = $_POST['nick'];

		$res = mExec('user',$teacher);
		$res2 = mExec('user_data',$teacher_data);
		echo ($res && res2)?'添加成功':'添加失败';
	}
}

//批量添加学生账号
if($_GET['pid'] == 3){
	$i=0;
	$illegal = "";
	foreach($_POST['account'] as $v){
		if(in_array($v,$arr)){
			$illegal .= "$v,";
			$i++;		
		}
	}
	if($i > 0){
		echo $illegal,"以上账号已存在,请重新填写";
		exit;
	}else{
		//构造user_sql语句
		$sql2 = "insert into user(user_account,user_password,permission_id) values";

		for($u = 0;$u < count($_POST['account']);$u++){
			$sql2 .="('".$_POST[account][$u]."','".md5Code($_POST[password][$u])."',3),";
		}
		
		$newsql2 = substr($sql2,0,strlen($sql2)-1);

		//构造user_data_sql语句
		$sql3 = "insert into user_data(user_account,user_nick) values";

		for($d = 0;$d < count($_POST['account']);$d++){
			$sql3 .="('".$_POST[account][$d]."','".$_POST[nick][$d]."'),";
		}
		$newsql3 = substr($sql3,0,strlen($sql3)-1);

		$res2 = mQuery($newsql2);
		$res3 = mQuery($newsql3);

		echo ($res2 && $res3)?'添加成功':'添加失败';
	}
}
 ?>
