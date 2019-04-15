<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>查看成绩</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="show_grade_container">
		<p class="show_grade_date">学生id，你好，今天星期一</p>
		<p class="show_grade_nav">作业&gt;<a href="#">查看作业</a>&gt;<a href="#" style="color:#26A5FF">查看成绩</a></p>
		<div class="clearfix"></div>
		<table>
			<tr>
				<th>作业标题</th>
				<th>作业提交时间</th>
				<th>成绩</th>
				<th>评语</th>
			</tr>
			<tr>
				<td>期末考：编写酒店管理系统</td>
				<td>2019/6/30</td>
				<td>61</td>
				<td>你这代码是copy不合格</td>
			</tr>
			<tr>
				<td>使用递归编写十进制转二进制程序</td>
				<td>2019/4/29</td>
				<td>4.0</td>
				<td></td>
		</tr>
		</table>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>