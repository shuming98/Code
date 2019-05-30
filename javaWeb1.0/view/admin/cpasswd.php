<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
 	<title>修改密码</title>
 </head>
 <style>
 	body{margin:0;padding: 0;background: #DDE6E9}
	.clearfix::after{display: block;content: '.';clear: both;height: 0;visibility: hidden;}
 	.container{width:500px;height:310px;background: #F1F3F7;margin:100px auto 0px auto;}
 	.container>h2{font-size: 24px;color:#fff;background: #5D82CC;padding:5px 0px;margin:0;padding-left:10px;}
 	.container>form{margin-top:5px;width:340px;margin:auto;}
 	.container>form>p{font-size: 20px;color:#000;}
 	.container>form>p>input[type=password]{margin-left:50px;font-size: 18px;padding:4px 6px;background: #E1E1E1;border:none;width:200px;}
 	.container>form>input[type=reset]{border:none;background: none;font-size: 16px;float:left;color:#999;cursor: pointer;outline: none;padding: 0px;margin-top:10px;}
 	.container>form>input[type=submit]{float:right;margin-right:13px;font-size: 18px;border:none;background:#5D82CC;color:#fff;padding:4px 24px;cursor: pointer}
 	.container>form>input[type=submit]:hover{box-shadow:2px 2px 2px #ccc}
 	.remark{display:block;font-size: 16px;text-align: center;}
 	.error{display: block;font-size: 18px;color:red;text-align: center;}
 	.success{display: block;font-size: 18px;color:blue;text-align: center;}
 	.success>a{color:#999;}
 </style>
 <body>
 	<div class="container">
 		<h2>修改密码</h2>
 		<form action="" method="post">
 			<p>原密码:<input type="password" name="old" required="required" maxlength="20"></p>
 			<p>新密码:<input type="password" name="new" required="required" maxlength="20"></p>
 			<p>确认新密码:<input type="password" name="renew" style="margin-left:10px" required="required" maxlength="20"></p>
 			<input type="reset" value="重置">
 			<input type="submit" value="确认">
 			<div class="clearfix"></div>
 		</form>
 		<hr style="border:1px solid #e9e9e9">
 		<span class="remark">注：允许输入数字和字母,共20位</span>
 		<?php 
if(!empty($_POST)){
	//var_dump($_POST);
	//echo '<br/>';
	$sql = "select user_password from user where user_account='$_SESSION[user_account]'";

	if(md5Code($_POST['old']) !== mGetOne($sql)){
		echo '<span class="error">ERROR：原密码错误<span>';
		exit;
	}

	if($_POST['new'] !== $_POST['renew']){
		echo '<span class="error">ERROR：两次密码输入不一致<span>';
		exit;
	}

	$newPassword = md5Code($_POST['new']);

	$sql2 = "update user set user_password='$newPassword' where user_account='$_SESSION[user_account]'";
	
	if(mQuery($sql2)){
		echo '<span class="success">密码修改成功,3秒后自动<a href="../../index.php">跳转</a>,请重新登录</span>';
		$_SESSION=array();
		setcookie("PHPSESSID","",time()-1,'/');
		session_destroy();
		header("refresh:3;url=../../index.php");
	}
}
?>
 	</div>
 </body>
 </html>

