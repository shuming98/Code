<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>讨论区发帖</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!--讨论区发帖-->
	<div class="forum_post_container">
		<p>讨论区&gt;<a href="#" style="color:#265AFF">发帖</a></p>
		<form action="#">
			<p>标题：<input type="text" placeholder="请输入标题"></p>
			<p>内容：</p>
			<textarea name=""></textarea>
			<select name="">
				<option value="默认分类">默认分类</option>
				<option value="分享">分享</option>
				<option value="求助">求助</option>
			</select>
			<input type="submit" value="发布">
		</form>
	</div>
	<?php include('foot.html');?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>

</html>