<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询首页模块
$sql = "select id,cat_name,num from news_cat left join (select cat_id,count(*) as num from home_news group by cat_id) as t on news_cat.id=t.cat_id order by id asc";
$module = mGetAll($sql);

$sql2 = "select count(*) from news_cat";
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
	<title>首页模块</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="module_query_container">
				<h2 class="h2_title">首页模块</h2>
				<span class="h2_line"></span>	
				<div class="query_result_container">
					<table class="query_result_table">
						<tr>
							<th>id</th>
							<th>模块名</th>
							<th>资讯数量</th>
							<th>数据操作</th>
						</tr>
					<?php foreach($module as $v){ ?>
						<tr>
							<td><?php echo $v['id']; ?></td>
							<td><?php echo $v['cat_name']; ?></td>
							<td><?php echo $v['num']; ?></td>
							<td><a class="res_modify" data-opcat="<?php echo $v['id']; ?>">修改</a></td>
						</tr>
					<?php } ?>	
					</table>
					<?php echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
				<!--修改模块名-模态框-->
				<div id="modify_catname" class="modal">
				<div class="modal_content animate">
					<h1>修改模块名</h1>
					<span id="modify_catname_close" class="close">&times;</span>
					<form id="modify_catname_form" method="post">
						<span>新模块名：<input type="text" maxlength="10" name="catname" required="required"></span>
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
//打开修改目录-模态框&&提交数据
$(".res_modify").click(function(event){
	var that =this;
	$("#modify_catname").css("display","block");
	 $("#modify_catname_form").unbind('submit').submit(function(){
		$.post('../admin/modify_data.php?opcat='+$(that).data('opcat'),$("#modify_catname_form").serialize(),function(res){
			alert(res);
			location.reload();
		});
	 });
	return false;
});

//关闭修改目录-模态框
$("#modify_catname_close").click(function(){
	$("#modify_catname").css("display","none");
});
</script>
</html>