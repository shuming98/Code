<?php session_start(); 
require('../../lib/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>Document</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="issue_container">
		<p class="issue_work_date">老师，你好，当前时间为16:12:36</p>
		<p class="issue_work_nav">作业&gt;<a href="#" style="color:#26A5FF;">发布作业</a>&gt;<a href="#">批改作业</a></p>
		<div class="clearfix"></div>
		<form action="" method="post" enctype="multipart/form-data">
			<p>标题：<input type="text" name="title"></p>
			<p>作业内容：</p>
			<textarea name="content" id="content" cols="30" rows="10"></textarea>
			<p>文件上传：<input type="file"></p>
			<p>截止日期：<input type="date"></p>
			<p>选择班级：<select name="class" id="">
				<option value="选择班级">选择班级</option>
				<option value="16计科">16计科</option>
			</select></p>
			<input type="submit" value="发布">
		</form>
	</div>
	<?php include('foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>