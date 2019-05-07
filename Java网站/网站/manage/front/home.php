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
			<div class="saying">
				<h2>数据无价</h2>
				<p>实行“删除”操作前</p>
				<p>三思而后行</p>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
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
</script>
</html>