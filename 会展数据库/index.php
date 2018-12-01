<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理系统登录页面</title>
<style>
    body{background: #f8f8f8;}
	#container{
		width: 1200px;
		height: 600px;
		margin: auto;
	}
	#main{
		width: 430px;
		height: 390px;
		margin: 100px auto;
		border: 1px solid #eee;

	}
	#logo{
		width: 150px;
		height: 150px;
		float: left;
	}
	#title_h2{
		font-size: 1.7em;
		float: left;
		font-weight: 300;
		text-indent: 30px;
	}
	#title_h1{
		font-size: 2em;
		float: left;
		position: relative;
		bottom: 30px;	
	}
	#login{
		float: left;
		margin-left: 50px;
	}
	#login>p{
		font-size: 1.5em;
	}
	.textbox{			
		padding: 5px 10px 5px;
		font-size: 1em;
	}
	.login_button{
		font-size: 1em;
		width: 100px;
		margin-left: 40px;
	}
	.error_p{
		text-align: center;
		color: red;
	}

</style>
</head>
<body>
	<div id="container">
		<div id="main">
			<img id="logo" src="./img/logo.png" alt="logo">
			<h2 id="title_h2"><i>无人经济体验展</i></h2>
				<h1 id="title_h1">网站数据管理系统</h1>
				<form id="login" action="./index.php" method="post">
					<p>账号：<input class="textbox" type="text" name="account"></p>
					<p>密码：<input class="textbox" type="password" name="password"></p>
					<input class="login_button" type="submit" value="登录">
					<input class="login_button" type="reset" value="重置">
				</form>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

	<?php  
	$account=$_POST['account'];
	$password=$_POST['password'];

	$conn=mysqli_connect('127.0.0.1','root','123456','uee');
	mysqli_query($conn,'set names utf8');
	$sql="select account,password from login where account='$account'";
	$res=mysqli_query($conn,$sql);
	$arr=mysqli_fetch_assoc($res);

	if((empty($account)) || (empty($password)))
	{
		echo '<p class="error_p">*请填写正确的账号和密码</p>';
		
	}
	else
	{
		if(($account==$arr['account']) && ($password==$arr['password']))
		{
			echo "<script>alert('登录成功,欢迎您$account');location.replace('./home/home.html');</script>";
		}
		else
		{
			echo '<p class="error_p">*账号或密码错误</p>';
			exit;
		}
	}
	?>
		</div>
	</div>
</body>
</html>