<?php 
require('../../lib/init.php');
$sql = "update resource set click_count=click_count+1 where resource_id=1";
mQuery($sql);
 ?>