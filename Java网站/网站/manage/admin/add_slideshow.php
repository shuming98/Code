<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//用户头像上传路径导入数据库
if(!($_FILES['slideshow']['name'] == '') && ($_FILES['slideshow']['error'] == 0)){
	$filename = createSlideshowDir() . '/' . randStr() . getExt($_FILES['slideshow']['name']);
	if(move_uploaded_file($_FILES['slideshow']['tmp_name'],ROOT . $filename)){
		$slideshow['pic_path'] = $filename;
	}
}

$slideshow['content'] = $_POST['content'];

$res = mExec('slideshow',$slideshow);
echo $res?'添加成功':'添加失败';
 ?>