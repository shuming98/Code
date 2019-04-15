<?php 
require('../../lib/init.php');
$resource_tag['tag_name'] = $_POST['tag_name'];
$res = mExec('resource_tag',$resource_tag);
echo '<script>location.replace(document.referrer);</script>';
 ?>