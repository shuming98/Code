<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询班级信息
$sql = "select user_account,t_name,t_class from teacher";
$class = mGetAll($sql);

$sql2 = "select count(*) from teacher";
$num = mGetOne($sql2);

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
	<title>班级信息维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="class_query_container">
				<h2 class="h2_title">班级信息维护</h2>
				<span class="h2_line"></span>
				<div class="query_result_container">
				<table class="query_result_table">
					<tr>
						<th>账号</th>
						<th>任课老师</th>
						<th>班级</th>
						<th>数据操作</th>
					</tr>
				<?php foreach($class as $v){ ?>
					<tr>
						<td><?php echo $v['user_account']; ?></td>
						<td><?php echo $v['t_name']; ?></td>
						<td><?php echo $v['t_class']; ?></td>
						<td><a class="res_remove" data-class="<?php echo $v['t_class']; ?>">删除</a></td>
					</tr>
				<?php } ?>
				</table>
				<?php 
				echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除班级数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?class='+$(this).data('class'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>