<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes"/>
	<link rel="stylesheet" type="text/css" href="./css/forum.css">
	<title>论坛</title>
</head>
<body>
	<div id="header">
		<div id="header_div1">
		<a href="./index.html"><img id="header_logo" src="./img/home/logo.png" alt="logo" /></a>
		<div id="header_div2">
		<ul class="nav">
			<li><a href="./index.html">Home</a></li>
			<li><a href="./download.html">Download</a></li>
			<li><a href="./install.html">Install</a></li>
			<li><a href="./forum.php">forum</a></li>
			<li><a href="./study.html">Learn Linux</a></li>
			<li><a href="./index.html#jump_joinus">Join us</a></li>
			<li><a id="header_signup" href="#">Sign up</a></li>
		</ul>
	</div>
	</div>
	</div>
	<br/>
	<br/>
	<span id="liuyan">留言框：</span>
	<form id="myForm" action="./img/forum/POST.php" method="post">
		<textarea name="textarea" id="textarea" placeholder="欢迎留言,提交留言后可在下方看到你的足迹。&#10;点击左上角logo可返回主页." cols="60" rows="8"></textarea>
		<input id="submit" type="submit"  value="提交" />
	</form>

	<!--读取留言-->
	<div id="border_top"></div>
	<h1 id="read_h1">留言栏</h1>
	<span class="read_span">轻风:&nbsp;&nbsp; South park</span>
	<div class="border_bottom"></div>
	<?php 
	$conn=mysqli_connect('localhost','root','','nglinux');
	mysqli_query($conn,'set names utf8');
	$sql="select id,content from forum";
	$res=mysqli_query($conn,$sql);

	if(!$res){
		echo '出错!';
		exit();
	}

	while($row=mysqli_fetch_assoc($res)){?>
	<span class="read_span">用户<?php echo $row['id']; ?>:&nbsp;&nbsp;<?php echo $row['content']; ?></span>
	<?php echo '<br/>'; ?>
	<div class="border_bottom"></div>
    <?php
     }
    mysqli_close($conn); ?>
</body>
</html>
