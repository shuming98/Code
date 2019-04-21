<?php 
require('../../lib/init.php');
$sql = "select count(*) from resource_tag";
if(mgetOne($sql)<5){
$resource_tag['tag_name'] = $_POST['tag_name'];
$res = mExec('resource_tag',$resource_tag);
echo $res?1:0;
}
//echo '<script>location.replace(document.referrer);</script>';
 ?>
