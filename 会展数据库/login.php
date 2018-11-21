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
	#login_button1{
		font-size: 1em;
		width: 100px;
		margin-left: 40px;
	}
	#login_button2{
		font-size: 1em;
		width: 100px;
		margin-left: 50px;
	}
</style>
</head>
<body>
	<div id="container">
		<div id="main">
			<img id="logo" src="./logo.png" alt="logo">
			<h2 id="title_h2"><i>无人经济体验展</i></h2>
				<h1 id="title_h1">网站信息管理系统</h1>
				<form id="login" action="#">
					<p>账号：<input class="textbox" type="text"></p>
					<p>密码：<input class="textbox" type="password"></p>
					<input id="login_button1" type="submit" value="登录">
					<input id="login_button2" type="reset" value="重置">
				</form>
		</div>
	</div>
</body>
</html>