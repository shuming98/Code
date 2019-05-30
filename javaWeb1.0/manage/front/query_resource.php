<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

/**
 * 实验分页功能
 */

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 10;

//查询该教师分类标签资源或全部资源
if(isset($_GET['account'])){
	$sql = "select tag_id,tag_name from resource_tag where user_account='$_GET[account]' order by tag_id asc";
	$tag = mGetAll($sql);

	if(isset($_GET['tag'])){
		$sql2 = "select resource_id,resource_name,resource_type,click_count from resource where user_account='$_GET[account]' and tag_id=$_GET[tag] order by resource_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
		$resource = mGetAll($sql2);

		$sql3 = "select count(*) from resource where user_account='$_GET[account]' and tag_id=$_GET[tag]";
		$num = mGetOne($sql3);
	}else{
		//查询该老师所有资源
		$sql4 = "select resource_id,resource_name,resource_type,click_count from resource where user_account='$_GET[account]' order by resource_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
		$resource = mGetAll($sql4);

		$sql5 = "select count(*) from resource where user_account='$_GET[account]'";
		$num = mGetOne($sql5);
	}
}

$pages = getPage($num,$current_page,$per_page_num);

if(isset($_GET['page']) && empty($resource)){
	echo '<script>history.back();</script>';
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
	<title>资源维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="resource_query_container">
				<h2 class="h2_title">课程资源维护</h2>
				<span class="h2_line"></span>
				<form>
					<input class="input_line" type="text" name="account" placeholder="请输入教师账号" maxlength="20" required="required">
					<input type="submit" value="查询">
				</form>
				<?php //标签筛选
				if(isset($tag) && !empty($tag)){
				echo '<p class="select_tag">根据分类进行筛选：';
					foreach($tag as $v){
						$_GET['tag']=$v['tag_id'];
						$_GET['page']=1;
						echo '<a href="./query_resource.php?',http_build_query($_GET),'">',$v['tag_name'],'</a>';
					}
					echo '</p>';
				} ?>
				<div class="query_result_container" style="height:450px;">
					<table class="query_result_table">
						<tr>
							<th>id</th>
							<th>资源名称</th>
							<th>资源类型</th>
							<th>下载数</th>
							<th>数据操作</th>
						</tr>
					<?php foreach($resource as $v){ ?>
						<tr>
							<td><?php echo $v['resource_id']; ?></td>
							<td><?php echo $v['resource_name']; ?></td>
							<td><?php echo $v['resource_type']; ?></td>
							<td><?php echo $v['click_count']; ?></td>
							<td><a class="res_remove" data-resource="<?php echo $v['resource_id']; ?>">删除</a></td>
						</tr>
					<?php } ?>
					</table>
					<?php echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
			<!--分页页号-->
			<div id="page_bar">
				<?php 
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./query_resource.php?',$v,'">',$k,'</a>';
						}
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除资源分类数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?resource='+$(this).data('resource'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>