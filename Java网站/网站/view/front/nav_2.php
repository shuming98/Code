<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>首页</title>
</head>
<body>
	<!--导航栏-->
	<div class="nav">
		<img class="nav_logo" src="../../images/icon/logo.png" alt="logo">
		<ul>
			<li><a href="#"><img src="../../images/icon/home.png" alt="home">首页</a></li>
			<li><a href="#"><img src="../../images/icon/resource.png" alt="resource">课程资源</a></li>
			<li><a href="#"><img src="../../images/icon/study.png" alt="study">学习园地</a></li>
			<li><a href="#"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
			<li><a href="#"><img src="../../images/icon/forum.png" alt="forum">讨论区</a></li>
			<li><a href="#"><img src="../../images/icon/about.png" alt="about">关于</a></li>
		</ul>
			<form action="#" method="get">	
				<input type="search" name="search" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;搜索...">
			</form>
		<a class="nav_login" href="#" onclick="document.getElementById('login').style.display='block'"><img src="../../images/icon/user.png" alt="login">登录</a>
	</div>

	<!--模态框登录-->
	<div id="login" class="modal">
		<form class="modal_content animate" action="../admin/login.php" method="post" >
			<div class="modal_img">
				<span onclick="document.getElementById('login').style.display='none'" class="close">&times;</span>
				<img src="../../images/icon/user.png" alt="user">
			</div>
			<div class="modal_form">
				<p><b>账号</b>:<input type="text" name="user_account" required="required" placeholder="请输入账号/学号"></p>
				<p><b>密码</b>:<input type="password" name="user_password" required="required" placeholder="请输入密码"></p>
				<p><input type="checkbox" checked="checked" name="remember">记住密码<a href="#">忘记密码?</a></p>
				<input type="submit" value="登录">
			</div>				
		</form>
	</div>
	<div class="clearfix"></div>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>