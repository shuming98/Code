<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询该教师添加的目录
if(isset($_GET['account'])){
	$sql = "select study_dir.dirname_id,dirname,art_num from study_dir left join (select dirname_id,count(*) as art_num from article group by dirname_id) as t on study_dir.dirname_id=t.dirname_id where user_account='$_GET[account]' order by dirname_id asc";
	$dir = mGetAll($sql);

	$sql2 = "select count(*) from study_dir where user_account='$_GET[account]'";
	$num = mGetOne($sql2);
}
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
	<title>目录摘要维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="dir_query_container">
				<h2 class="h2_title">目录摘要维护</h2>
				<span class="h2_line"></span>
				<form action="" method="get">
					<input class="input_line" type="text" name="account" placeholder="请输入教师账号" maxlength="20" required="required">
					<input type="submit" value="查询">
				</form>
				<div class="query_result_container">
					<table class="query_result_table">
						<tr>
							<th>id</th>
							<th>目录名</th>
							<th>文章数量</th>
							<th colspan="2">数据操作</th>
						</tr>
					<?php foreach($dir as $v){ ?>
						<tr>
							<td><?php echo $v['dirname_id']; ?></td>
							<td><?php echo $v['dirname']; ?></td>
							<td><?php echo ($v['art_num'] !== NULL)?$v['art_num']:0; ?></td>
							<td><a class="res_modify" data-opdir="<?php echo $v['dirname_id']; ?>">修改</a></td>
							<td><a class="res_remove" data-dir="<?php echo $v['dirname_id']; ?>">删除</a></td>
						</tr>
					<?php } ?>
					</table>
					<?php echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
			<!--修改目录名-模态框-->
			<div id="modify_dirname" class="modal">
				<div class="modal_content animate">
					<h1>修改目录名</h1>
					<span id="modify_dirname_close" class="close">&times;</span>
					<form id="modify_dirname_form" method="post">
						<span>新目录名：<input type="text" maxlength="15" name="dirname" required="required"></span>
						<input type="submit" value="修改">
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除目录数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?dir='+$(this).data('dir'),function(res){
		alert(res);
		location.reload();
	});
});

//打开修改目录-模态框&&提交数据
$(".res_modify").click(function(event){
	var that =this;
	$("#modify_dirname").css("display","block");
	$("#modify_dirname_form").unbind('submit').submit(function(){
		$.post('../admin/modify_data.php?opdir='+$(that).data('opdir'),$("#modify_dirname_form").serialize(),function(res){
			alert(res);
			location.reload();
		});
	});
	return false;
});

//关闭修改目录-模态框
$("#modify_dirname_close").click(function(){
	$("#modify_dirname").css("display","none");
});
</script>
</html>