<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

if(isset($_GET['account'])){
	//查询该教师添加的资源标签
	$sql = "select resource_tag.tag_id,tag_name,t.sum from resource_tag left join (select tag_id,count(*) as sum from resource group by tag_id) as t on resource_tag.tag_id=t.tag_id where user_account='$_GET[account]' order by resource_tag.tag_id asc";
	$res = mGetAll($sql);

	$sql2 = "select count(*) from resource_tag where user_account='$_GET[account]'";
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
	<title>资源分类维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="tag_query_container">
				<h2 class="h2_title">资源分类维护</h2>
				<span class="h2_line"></span>
			<form action="" method="get">
				<input class="input_line" type="text" name="account" maxlength="20" placeholder="请输入教师账号" required="required">
				<input type="submit" value="查询">
			</form>
				<div class="query_result_container">			
				<table class="query_result_table">
					<tr>
						<th>id</th>
						<th>标签名</th>
						<th>资源数量</th>
						<th colspan="2">数据操作</th>
					</tr>
				<?php foreach($res as $v){ ?>
					<tr>
						<td><?php echo $v['tag_id']; ?></td>
						<td><?php echo $v['tag_name']; ?></td>
						<td><?php echo $v['sum']; ?></td>
						<td><a class="res_modify" data-optag="<?php echo $v['tag_id']; ?>">修改</a></td>
						<td><a class="res_remove" data-tag="<?php echo $v['tag_id']; ?>">删除</a></td>
					</tr>
				<?php } ?>
				</table>
				<?php  echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'?>
				</div>
				<!--修改标签名-模态框-->
			<div id="modify_tagname" class="modal">
				<div class="modal_content animate">
					<h1>修改标签名</h1>
					<span id="modify_tagname_close" class="close">&times;</span>
					<form id="modify_tagname_form" method="post">
						<span>新标签名：<input type="text" maxlength="10" name="tagname" required="required"></span>
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
//ajax删除资源分类数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?tag='+$(this).data('tag'),function(res){
		alert(res);
		location.reload();
	});
});

//打开修改班级-模态框&&提交数据
$(".res_modify").click(function(event){
	var that =this;
	$("#modify_tagname").css("display","block");
	$("#modify_tagname_form").unbind('submit').submit(function(){
		$.post('../admin/modify_data.php?optag='+$(that).data('optag'),$("#modify_tagname_form").serialize(),function(res){
			alert(res);
			location.reload();
		});
	});
	return false;
});

//关闭修改标签-模态框
$("#modify_tagname_close").click(function(){
	$("#modify_tagname").css("display","none");
});
</script>
</html>