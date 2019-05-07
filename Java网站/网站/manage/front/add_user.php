<?php 
session_start();
require('../../lib/init.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/manage.css">
	<script src="../../js/jquery.js"></script>
	<title>后台管理</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<div class="sidenav">
			<button class="dropdown_btn">首页内容管理</button>
			  <div class="dropdown_container">
			    <a href="#">轮播图</a>
			    <a href="#">发布文章</a>
			    <a href="#">添加外链</a>
			    <a href="#">最新资讯</a>
			    <a href="#">优秀学生作品</a>
			    <a href="#">站外资讯</a>
			    <a href="#">优秀师生</a>
			  </div>
			<button class="dropdown_btn">用户管理</button>
			  <div class="dropdown_container">
			    <a href="#">用户信息添加</a>
			    <a href="#">用户信息查询</a>
			    <a href="#">用户信息维护</a>
			  </div>
			<button class="dropdown_btn">班级管理</button>
			  <div class="dropdown_container">
			    <a href="#">班级添加</a>
			    <a href="#">班级信息维护</a>
			  </div>
			 <button class="dropdown_btn">课程资源管理</button>
			  <div class="dropdown_container">
			    <a href="#">资源分类维护</a>
			    <a href="#">资源维护</a>
			  </div>
		</div>
		<div class="function">
			<div class="user_add_container">
				<h2>添加管理员用户</h2>
				<span class="h2_line"></span>
				<form action="" method="get" accept-charset="utf-8">
					<p>
						<span>账号：<input type="text" name="account" required="required" maxlength="20"></span>
						<span>密码：<input type="password" name="password" required="required" maxlength="20"></span>
						<span>昵称：<input type="text" name="nick" required="required" maxlength="20"></span>
					<input type="submit" value="添加">
					</p>
				</form>
				<h2>添加老师用户</h2>
				<span class="h2_line"></span>
				<form action="" method="get" accept-charset="utf-8">
					<p>
						<span>账号：<input type="text" name="account" required="required" maxlength="20"></span>
						<span>密码：<input type="password" name="password" required="required" maxlength="20"></span>
						<span>昵称：<input type="text" name="nick" required="required" maxlength="20"></span>
					<input type="submit" value="添加">
					</p>
				</form>
				<h2 class="add_stu_h2">添加学生用户</h2>
				<img class="img_icon" id="add_user" src="../../images/icon/add.png" alt="add">
				<img class="img_icon" id="minus_user" src="../../images/icon/minus.png" alt="minus">
				<span id="add_count"></span>
				<div class="clearfix"></div>
				<span class="h2_line"></span>
				<form id="add_user_form" action="" method="get" accept-charset="utf-8">
					<div class="add_content">
					<p class="add_user_temp">
						1.<span>账号：<input type="text" name="account[]" required="required" maxlength="20"></span>
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
//侧边导航栏
var dropdown = document.getElementsByClassName("dropdown_btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

var num=1;
//添加选择题表单
$("#add_user").click(function(){
	num++;
	var text = '<p class="add_user_temp">'+num+'.<span>账号：<input type="text" name="account[]" required="required" maxlength="20"></span> <span>密码：<input type="password" name="password[]" required="required" maxlength="20"></span> <span>昵称：<input type="text" name="nick[]" maxlength="20"></span></p>';
	$(".add_content").append(text);
	$("#add_count").text("你已添加"+num+"个用户表单");
});

//删除选择题表单
$("#minus_user").click(function(){
	num--;
	if(num<0){
		return num=0;
	}
	$(".add_user_temp:last-child").remove();
	$("#add_count").text("你已添加"+num+"个用户表单")
});
</script>
</html>