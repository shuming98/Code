<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');
$submit_work['score'] = $_POST['score'];
$submit_work['comment'] = $_POST['comment'];
$user_account = $_GET['user_account'];
$work_id = $_GET['work_id'];

$res = mExec('submit_work',$submit_work,'update',"user_account='$_GET[user_account]' and work_id=$_GET[work_id]");
echo $res?'成绩录入成功':'成绩录入失败';
 ?>