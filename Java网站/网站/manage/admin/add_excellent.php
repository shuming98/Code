<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//用户头像上传路径导入数据库
if(!($_FILES['figure']['name'] == '') && ($_FILES['figure']['error'] == 0)){
	$filename = createExcellentDir() . '/' . randStr() . getExt($_FILES['figure']['name']);
	if(move_uploaded_file($_FILES['figure']['tmp_name'],ROOT . $filename)){
		$excellent['pic_path'] = $filename;
	}
}

$excellent['identify'] = $_POST['identify'];
$excellent['name'] = $_POST['name'];

$res = mExec('excellent',$excellent);
echo $res?'添加成功':'添加失败';

?>