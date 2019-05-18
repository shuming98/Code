<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');
$study_dir['user_account'] = $_SESSION['user_account'];
$study_dir['dirname'] = $_POST['dirname'];

$res = mExec('study_dir',$study_dir);
echo $res?'添加成功':'添加失败';
 ?>