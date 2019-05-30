<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');

$resource['resource_name']=$_POST['resource_name'];

//通过tag_name获取tag_id
$sql = "select tag_id from resource_tag where tag_name='$_POST[tag_name]'";
$tag_id = mGetRow($sql);
$resource['tag_id'] = $tag_id['tag_id'];

$resource['user_account'] = $_SESSION['user_account'];


//获取文件类型
$resource['resource_type'] = str_replace('.','',getExt($_FILES['resource']['name']));

//将文件路径导入数据库
if(!($_FILES['resource']['name'] == '') && ($_FILES['resource']['error'] == 0)){
	$filename = createCourseResourceDir() . '/' . randStr() . getExt($_FILES['resource']['name']);
	if(move_uploaded_file($_FILES['resource']['tmp_name'],ROOT . $filename)){
		$resource['resource_path'] = $filename;
	}
}


$res = mExec('resource',$resource);


if($res){
	echo '文件上传成功';
}else{
	echo '文件上传失败,请重新上传';
}
 ?>