<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//输出该学生试题标题
$sql = "select teacher.user_account from user_data inner join teacher on user_data.class=teacher.t_class where user_data.user_account='$_SESSION[user_account]'";
$teacher = mGetOne($sql);

$sql2 = "select test_id,title from test where user_account='$teacher'";
$test_title = mGetAll($sql2);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
 	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
 	<title>试题练习</title>
 </head>
 <body>
 	<?php include('./nav.php'); ?>
 	<div class="ready_test">
 		<h1>（请在下方选择试题——开始测验）</h1>
 		<form action="./start_test.php" method="get">
 			<select name="test_id">
 			<?php foreach($test_title as $v){
 				echo '<option value="',$v['test_id'],'">',$v['title'],'</option>';
 			}?>
 			</select>
 			<input type="submit" value="开始测验">
 		</form>
 	</div>
 	<?php include('./foot.html'); ?>
 </body>
 </html>