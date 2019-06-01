<?php 
$op = $_GET['name'];
//$op = $_POST['name'];
$arr = array('lisi','zhaoliu','zhaosi','liuneng');
echo in_array($op,$arr)?1:0;
?>