<?php session_start(); 
require('../../lib/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>查看作业</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<!--学生查看作业-->
	<div class="show_work_container">
		<p class="show_work_date">学生id，你好，今天星期一</p>
		<p class="show_work_nav">作业&gt;<a href="#" style="color:#26A5FF">查看作业</a>&gt;<a href="#">查看成绩</a></p>
		<div class="clearfix"></div>
		<div class="show_work_content">
			<button type="button" onclick="document.getElementById('show_work').style.display='block'">查看</button>
			<h2>&gt;使用递归编写十进制转二进制,需要发代码和执行结果图</h2>
			<p>截止日期：2019/4/30 00:00:00</p>
			<p>上一次提交时间：2019/4/29 16:42:36</p>
			<p>得分：4.0</p>
			<p>评语：很好</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<!--查看作业模态框-->
	<div id="show_work" class="modal">
		<div class="show_modal_content animate">
			<span class="close" onclick="document.getElementById('show_work').style.display='none'">&times;</span>
			<h2>&gt;使用递归编写十进制转二进制,需要发代码和执行结果图</h2>
			<p>详细内容:请利用递归的特性完成，并写一个循环，允许用户反复输入。</p>
			<p>文件名：<a href="#">点击下载</a></p>
			<form action="#" method="get" accept-charset="utf-8" enctype="multipart/form-data">
				<p>提交文本答案:</p>
				<textarea name=""></textarea>
				<p>上传文件:<input type="file" name=""></p>
				<input type="submit" name="" value="提交">
			</form>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>

</html>