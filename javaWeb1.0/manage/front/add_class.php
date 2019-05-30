<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//输出所有教师
$sql = "select user.user_account,user_nick from user inner join user_data on user.user_account=user_data.user_account where permission_id in (1,2) order by user_id asc";
$teacher = mGetAll($sql);
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
	<title>添加班级</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>	
		<div class="function">
			<div class="class_add_container">
				<h2 class="h2_title">添加班级</h2>
				<span class="h2_line"></span>
				<form id="add_class_form" method="post">
					<p>班级名字：<input type="text" name="class" maxlength="20" required="required"></p>
					<p>任课老师：<select name="teacher">
						<?php foreach($teacher as $v){
							echo '<option value="',$v['user_account'],'">',$v['user_nick'],'</option>';
						} ?>
					</select></p>
					<input type="submit" value="添加">
				</form>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax添加班级
$("#add_class_form").submit(function(){
	$.post('../admin/add_class.php',$("#add_class_form").serialize(),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>