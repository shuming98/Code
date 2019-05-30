<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

/**
 * 实现分页功能
 */

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 12;

//查询该老师发布作业的数据
if(isset($_GET['account'])){
	$sql = "select work_id,class,work_title,issue_date from issue_work where user_account='$_GET[account]' order by work_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$work = mGetAll($sql);

	$sql2 = "select count(*) from issue_work where user_account='$_GET[account]'";
	$num = mGetOne($sql2);
}

$pages = getPage($num,$current_page,$per_page_num);

if(isset($_GET['page']) && empty($work)){
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
	<title>作业发布维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="work_query_container">
				<h2 class="h2_title">作业发布维护</h2>
				<span class="h2_line"></span>
				<form action="" method="get">
					<input class="input_line" type="text" name="account" maxlength="20" placeholder="请输入教师账号" required="required">
					<input type="submit" value="查询">
				</form>
				<div class="query_result_container">
					<table class="query_result_table">
						<tr>
							<th>id</th>
							<th>班级</th>
							<th>作业标题</th>
							<th>发布时间</th>
							<th>数据操作</th>
						</tr>
					<?php foreach($work as $v){ ?>
						<tr>
							<td><?php echo $v['work_id']; ?></td>
							<td><?php echo $v['class']; ?></td>
							<td><?php echo $v['work_title']; ?></td>
							<td><?php echo $v['issue_date']; ?></td>
							<td><a class="res_remove" data-work="<?php echo $v['work_id']; ?>">删除</a></td>
						</tr>
					<?php } ?>
					</table>
					<?php echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
			<!--分页页号-->
			<div id="page_bar">
				<?php 
					if($current_page>1){
						$_GET['page']=$current_page-1;
						echo '<a href="./query_work.php?',http_build_query($_GET),'">&lt;</a>';
					}
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./query_work.php?',$v,'">',$k,'</a>';
						}
					}
					end($pages);
					if($current_page<key($pages)){
						$_GET['page']=$current_page+1;
						echo '<a href="./query_work.php?',http_build_query($_GET),'">&gt;</a>';
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除作业发布数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?work='+$(this).data('work'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>