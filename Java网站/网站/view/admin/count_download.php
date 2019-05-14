<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

$sql = "update resource set click_count=click_count + 1 where resource_id = $_GET[resource_id]";

mQuery($sql);

 ?>