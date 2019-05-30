<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<link rel="stylesheet" type="text/css" href="../../css/manage.css">
	<script src="../../js/jquery.js"></script>
	<title>添加用户</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="user_add_container">
				<h2 class="h2_title">添加管理员用户</h2>
				<span class="h2_line"></span>
				<hr>
				<form id="add_admin_form" method="post">
					<p>
						<span>账号：<input type="text" name="account" required="required" maxlength="20" oninput="value=value.replace(/[\W]/g,'')"></span>
						<span>密码：<input type="password" name="password" required="required" maxlength="20"></span>
						<span>昵称：<input type="text" name="nick" required="required" maxlength="20"></span>
					<input type="submit" value="添加">
					</p>
				</form>
				<hr class="hr_10">
				<h2 class="h2_title" style="margin-top:15px">添加老师用户</h2>
				<span class="h2_line"></span>
				<hr>
				<form id="add_tea_form" method="post">
					<p>
						<span>账号：<input type="text" name="account" required="required" maxlength="20" oninput="value=value.replace(/[\W]/g,'')"></span>
						<span>密码：<input type="password" name="password" required="required" maxlength="20"></span>
						<span>昵称：<input type="text" name="nick" required="required" maxlength="20"></span>
					<input type="submit" value="添加">
					</p>
				</form>
				<hr class="hr_10">
				<h2 class="add_stu_h2 h2_title">添加学生用户</h2>
				<img class="img_icon" id="add_user" src="../../images/icon/add.png" alt="add">
				<img class="img_icon" id="minus_user" src="../../images/icon/minus.png" alt="minus">
				<span id="add_count"></span>
				<div class="clearfix"></div>
				<span class="h2_line"></span>
				<hr>
				<form id="add_user_form" method="post" accept-charset="utf-8">
					<div class="add_content">
					<p class="add_user_temp">
						1.<span>账号：<input type="text" name="account[]" required="required" maxlength="20" oninput="value=value.replace(/[\W]/g,'');"></span>
						<span>密码：<input type="password" name="password[]" required="required" maxlength="20"></span>
						<span>昵称：<input type="text" name="nick[]" maxlength="20"></span>
					</p>
					</div>
					<input type="submit" value="添加">
				</form>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
var num=1;
//添加用户表单
$("#add_user").click(function(){
	num++;
	var text = '<p class="add_user_temp">'+num+'.<span>账号：<input type="text" name="account[]" required="required" maxlength="20"></span> <span>密码：<input type="password" name="password[]" required="required" maxlength="20"></span> <span>昵称：<input type="text" name="nick[]" maxlength="20"></span></p>';
	$(".add_content").append(text);
	$("#add_count").text("你已添加"+num+"个用户表单");
});

//删除用户表单
$("#minus_user").click(function(){
	num--;
	if(num<0){
		return num=0;
	}
	$(".add_user_temp:last-child").remove();
	$("#add_count").text("你已添加"+num+"个用户表单")
});

//ajax添加管理员用户
$("#add_admin_form").submit(function(){
	$.post('../admin/add_user.php?pid=1',$("#add_admin_form").serialize(),function(res){
		alert(res);
	});
	return false;
});

//ajax添加教师用户
$("#add_tea_form").submit(function(){
	$.post('../admin/add_user.php?pid=2',$("#add_tea_form").serialize(),function(res){
		alert(res);
	});
	return false;
});

//ajax添加学生用户
$(document).ready(function(){
	$("#add_user_form").submit(function(){
		$.post('../admin/add_user.php?pid=3',$("#add_user_form").serialize(),function(res){
			alert(res);
		});
		return false;
	});
});

</script>
</html>