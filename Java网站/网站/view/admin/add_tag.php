<?php 
require('../../lib/init.php');
$sql = "select count(*) from resource_tag";
if(mgetOne($sql)<5){
$resource_tag['tag_name'] = $_POST['tag_name'];
$res = mExec('resource_tag',$resource_tag);
echo $res?'添加成功,请手动刷新页面':'添加失败';
}else{
	echo '标签已超过5个';
}
 ?>
