<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name=”viewport” content="initial-scale=2.0,width=device-width,user-scalable=yes"/>
	<title>论坛</title>
</head>
<style>
div{
		text-decoration: none;
		font-family:Helvetica,Tahoma,"微软雅黑","华文细黑","Microsoft YaHei",sans-serif;
	}
	#nav li{
		display: inline;
	}
	#nav li a{
	text-decoration: none;
	font-size:x-large;
	font-weight: bold;
	padding: 0px 10px 0px;
	color:#222;
	line-height: 23px;
	}
	#nav li a:visited{
	color:#111;
	}
	#nav li a:hover{
	color:#4fd2c2;
	}
	
	
</style>
<body style="background: #f8f8f8;margin:0px;overflow-x: hidden;">
	<canvas id="d1" width="800" height="600" style="position:fixed;z-index:-1200;filter: alpha(opacity:50);opacity: 0.5;left:500px;"></canvas>
	<div id="header" style="height:55px;width:100%;background: #fff;">
		<div id="header" style="height:39px;width:100%;background: #fff;">
		<div style="width: 1200px;margin:auto;">
		<a href="./index.html"><img style="width: 200px;height: 50px;float: left;margin-left: -8px;" src="./首页/新首页图片/login.png" alt="login" /></a>
		<div style="height:50px;float: right;margin-right: 58px;">
		<ul id="nav" style="list-style-type: none;">
			<li><a href="./index.html">Home</a></li>
			<li><a href="./下载.html">Download</a></li>
			<li><a href="./安装.html">Install</a></li>
			<li><a href="./论坛.php">forum</a></li>
			<li><a href="./学习Linux.html">Learn Linux</a></li>
			<li><a href="./index.html#joinus">Join us</a></li>
			<li id="signup"><a style="color:#fff;background: #4fd2c2;padding: 5px 3px 5px;border-radius: 15px;margin-left: 15px;" href="#">Sign up</a></li>
		</ul>
	</div>
	</div>
	</div>
	<br/>
	<br/>
	<span style="font-size: 30px;">留言框：</span>
	<form id="myForm" action="./论坛/POST.php" method="post">
		<textarea style="margin-left:100px; font-size: 20px;background: transparent;" name="textarea" id="textarea" placeholder="欢迎留言,提交留言后可在下方看到你的足迹。&#13;&#10;点击左上角logo可返回主页." cols="60" rows="8"></textarea>
		<input style="padding: 3px 5px 3px;font-size: 20px;cursor: pointer;" type="submit"  value="提交" />
	</form>

	<!--读取留言-->
	<div style="border-top:1px dashed #999;margin-top:20px;"></div>
	<h1 style="margin:auto;text-align: center;border-bottom: 1px dashed #999;">留言栏</h1>
	<span style="font-size: 1.3em;color:red;padding: 33px;">轻风:&nbsp&nbsp最近沉迷Hollow Knight，忘记更新了!-_-!</span>
	<div style="border-bottom: 1px dashed #999;"></div>
	<?php 
	$conn=mysqli_connect('localhost','root','flzx_3QC','nglinux');
	mysqli_query($conn,'set names utf8');
	$sql="select id,content from forum";
	$res=mysqli_query($conn,$sql);

	if(!$res){
		echo '出错!';
		exit();
	}

	while($row=mysqli_fetch_assoc($res)){?>
	<span style="font-size: 1.3em;padding: 33px;">用户<?php echo $row['id']; ?>:&nbsp&nbsp<?php echo $row['content']; ?></span>
	<?php echo '<br/>'; ?>
	<div style="border-bottom: 1px dashed #999;"></div>
    <?php
     }
    mysqli_close($conn); ?>
</body>
</html>
