<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');
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
	<script src="../../js/jquery.js"></script>
	<title>添加试题</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<form id="add_test_form" class="add_test_container modal_radius" method="post">
		<h1 class="modal_radius">添加试题</h1>
		<input type="text" name="title" placeholder="请输入试题名字,如选择题一" required="required" maxlength="20">
		<div class="add_choice_container">
		<h2>一、选择题</h2>
		<span class="add_icon" id="add_choice">+</span>
		<span class="minus_icon" id="minus_choice">&#8211;</span>
		<span>(点击"+"号添加,"-"号删除)</span>
		<span id="add_count"></span>
		<div class="clearfix"></div>
		<div class="add_content">
			<div class="add_choice_temp">
				<p>1.<input type="text" name="q[]" required="required"></p>
				<p class="choice_answer">A.<input type="text" name="A[]" required="required">B.<input type="text" name="B[]" required="required">C.<input type="text" name="C[]" required="required">D.<input type="text" name="D[]" required="required">答案:<select name="res[]">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
				</select></p>
			</div>
		</div>
		</div>	
			<input type="submit" value="提交">
		</form>
		<?php include('./foot.html'); ?>
</body>	
<script src="../../js/add_test.js"></script>
</html>