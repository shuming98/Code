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

//查询该教师发布的文章
if(isset($_GET['account'])){
	$sql = "select art_id,dirname,art_title from article inner join study_dir on article.dirname_id=study_dir.dirname_id where article.user_account='$_GET[account]' order by article.dirname_id,art_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$article = mGetAll($sql);

	$sql2 = "select count(*) from article where user_account='$_GET[account]' and dirname_id!=0";
	$num = mGetOne($sql2);
}

$pages = getPage($num,$current_page,$per_page_num);

if(isset($_GET['page']) && empty($article)){
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
	<title>文章维护</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="article_query_container">
				<h2 class="h2_title">文章维护</h2>
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
							<th>文章标题</th>
							<th>数据操作</th>
						</tr>
					<?php foreach($article as $v){ ?>
						<tr>
							<td><?php echo $v['art_id']; ?></td>
							<td><?php echo $v['dirname']; ?></td>
							<td><?php echo $v['art_title']; ?></td>
							<td><a class="res_remove" data-article="<?php echo $v['art_id']; ?>">删除</a></td>
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
						echo '<a href="./query_article.php?',http_build_query($_GET),'">&lt;</a>';
					}
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./query_article.php?',$v,'">',$k,'</a>';
						}
					}
					end($pages);
					if($current_page<key($pages)){
						$_GET['page']=$current_page+1;
						echo '<a href="./query_article.php?',http_build_query($_GET),'">&gt;</a>';
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除文章数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?article='+$(this).data('article'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>