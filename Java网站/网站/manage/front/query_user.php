<?php 
session_start();
require('../../lib/init.php');

//查询所有班级
$sql = "select t_class from teacher group by t_class";
$class = mGetAll($sql);

//权限查询
if(isset($_GET['permission'])){
	$sql2 = "select user_data.user_account,user_nick,gender,tel,class from user_data inner join user on user_data.user_account=user.user_account where user.permission_id=$_GET[permission]";
	$res = mGetAll($sql2);
}

//班级查询
if(isset($_GET['class'])){
	$sql3 = "select user_account,user_nick,gender,tel,class from user_data where class='$_GET[class]'";
	$res = mGetAll($sql3);
}

//账号查询
if(isset($_GET['account'])){
	$sql4 = "select user_account,user_nick,gender,tel,class from user_data where user_account='$_GET[account]'";	
	$res = mGetAll($sql4);
}
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
			<div class="user_query_container">
				<h2>用户信息查询</h2>
				<span class="h2_line"></span>
			<div>	
				<span class="query_acc">权限:</span>
				<form action="" method="get" accept-charset="utf-8">
					<select name="permission">
						<option value="0">管理员</option>
						<option value="1">教师</option>
						<option value="3">学生</option>
					</select>
					<input type="submit" value="查询">
				</form>
				<span class="query_acc">班级:</span>
				<form action="" method="get" accept-charset="utf-8">
					<select name="class">
						<?php foreach($class as $v){
							echo '<option value="',$v['t_class'],'">',$v['t_class'],'</option>';
						}?>
					</select>
					<input type="submit" value="查询">
				</form>
				<span class="query_acc">账号:</span>
				<form action="" method="get" accept-charset="utf-8">
					<input type="text" name="account" placeholder="请输入用户账号">
					<input type="submit" value="查询">
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="query_result_container">
				<table class="query_result_table">
					<tr>
						<th>账号</th>
						<th>昵称</th>
						<th>性别</th>
						<th>联系方式</th>
						<th>班级</th>
						<th colspan="2">数据操作</th>

					</tr>
					<?php foreach($res as $v){ ?>
					<tr>
						<td><?php echo $v['user_account']; ?></td>
						<td><?php echo $v['user_nick']; ?></td>
						<td><?php echo $v['gender']; ?></td>
						<td><?php echo $v['tel']; ?></td>
						<td><?php echo $v['class']; ?></td>
						<td><a class="res_modify">修改</a></td>
						<td><a class="res_remove" data-account="<?php echo$v['user_account']; ?>">删除</a></td>	
					</tr>
					<?php } ?>
				</table>
			</div>
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

//ajax删除数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?account='+$(this).data('account'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>