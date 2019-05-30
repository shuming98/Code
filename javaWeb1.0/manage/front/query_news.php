<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询模块名称
$sql = "select id,cat_name from news_cat";
$catname = mGetAll($sql);

/**
 * 实现分页功能
 */

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 12;

//查询模块文章
if(isset($_GET['module'])){
	$sql2 = "select home_news.id,cat_name,title,pubtime from home_news inner join news_cat on home_news.cat_id=news_cat.id where home_news.cat_id=$_GET[module] order by home_news.id desc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$news = mGetAll($sql2);

	$sql3 = "select count(*) from home_news where cat_id=$_GET[module]";
	$num = mGetOne($sql3);

	if(isset($_GET['page']) && empty($news)){
		echo '<script>history.back();</script>';
	}
}

$pages = getPage($num,$current_page,$per_page_num);

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
	<title>模块资讯查询</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="query_news_container">
				<h2 class="h2_title">模块资讯查询</h2>
				<span class="h2_line"></span>
				<form action="" method="get">
					<span>请选择模块：</span>
					<select name="module">
					<?php foreach($catname as $v){ 
						echo '<option value="',$v['id'],'">',$v['cat_name'],'</option>';
					} ?>
					</select>
					<input type="submit" value="查询">
				</form>
				<div class="query_result_container">
					<table class="query_result_table">
						<tr>
							<th>id</th>
							<th>模块名</th>
							<th>标题</th>
							<th>发布时间</th>
							<th>数据操作</th>
						</tr>
						<?php foreach($news as $v){ ?>
						<tr>
							<td><?php echo $v['id']; ?></td>
							<td><?php echo $v['cat_name']; ?></td>
							<td><?php echo $v['title']; ?></td>
							<td><?php echo $v['pubtime']; ?></td>
							<td><a class="res_remove" data-news="<?php echo $v['id']; ?>">删除</a></td>
						</tr>
						<?php } ?>
					</table>
					<?php echo '<span class="query_num">* 一共查询到 ',$num,' 条数据</span>'; ?>
				</div>
			<!--分页页号-->
			<div id="page_bar" style="top:0px;">
				<?php 
					if($current_page > 1){
						$_GET['page']=$current_page-1;
						echo '<a class="page_symbol" href="./query_news.php?',http_build_query($_GET),'">&lt;</a>';
					}
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./query_news.php?',$v,'">',$k,'</a>';
						}
					}
					end($pages);
					if($current_page < key($pages)){
						$_GET['page']=$current_page+1;
						echo '<a class="page_symbol" href="./query_news.php?',http_build_query($_GET),'">&gt;</a>';
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除资讯数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?news='+$(this).data('news'),function(res){
		alert(res);
		location.reload();
	});
});
</script>
</html>