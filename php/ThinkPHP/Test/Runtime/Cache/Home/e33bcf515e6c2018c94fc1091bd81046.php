<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>头header</h1>
</body>
</html>
<!-- <script type="text/javascript" src="/PHP/ThinkPHP/Shop/Public/Home/Js/xxx.js"></script>
<script type="text/javascript" src="/PHP/ThinkPHP/Shop/Public/Home/Js/xxx.js"></script> -->
	<h1>haha很好</h1>
	栏目：<a href="<?php echo U('Home/User/op_assign',array('id'=>12,'pp'=>5));?>">删除</a>
	栏目：<a href="<?php echo U('Home/User/op_assign','id=8&page=3');?>">增加</a>
	<form action="" method="post">
		<input type="text" name="name">
		<input type="submit">
	</form>
<footer>
	<h1>尾部footer</h1>
</footer>
</body>
</html>