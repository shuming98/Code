<?php 
session_start(); 
require('../../lib/init.php');

/**
 * 实现分页功能
 */

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 17;

if(isset($_GET['news'])){
	$sql = "select cat_name from news_cat where id=$_GET[news]";
	$catname = mGetOne($sql);

	$sql2 = "select id,title,link,pubtime from home_news where cat_id=$_GET[news] order by id desc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$news = mGetAll($sql2);

	$sql3 = "select count(*) from home_news where cat_id=$_GET[news]";
	$num = mGetOne($sql3);
}

$pages = getPage($num,$current_page,$per_page_num);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>Document</title>
</head>
<body style="background: #efefef;">
	<!--导航栏-->
	<div class="nav">
		<img class="nav_logo" src="../../images/icon/logo.png" alt="logo">
		<ul>
			<li><a href="../../index.php"><img src="../../images/icon/home.png" alt="home">首页</a></li>
			<li><a href="./resource.php"><img src="../../images/icon/resource.png" alt="resource">课程资源</a></li>
			<li><a href="./study.php"><img src="../../images/icon/study.png" alt="study">学习园地</a></li>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li><a href="./check_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
		<?php }else { ?>
			<li><a href="./show_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
		<?php } ?>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li><a href="./t_test.php"><img src="../../images/icon/about.png" alt="about">发布试题</a></li>
		<?php }else{ ?>
			<li><a href="./s_test.php"><img src="../../images/icon/about.png" alt="about">试题练习</a></li>
		<?php } ?>	
			<li><a href="./forum.php"><img src="../../images/icon/forum.png" alt="forum">讨论区</a></li>
		</ul>
	</div>
	<div class="clearfix"></div>
	<div class="more_news_container">
		<p class="more_news_nav"><a href="../../index.php">首页</a>&gt;<span><?php echo $catname; ?></span></p>
		<div class="list_more_container">
			<ul class="list_more_news">
			<?php foreach($news as $v){ ?>
				<li>
					<?php if($v['link'] == null){
						echo '<a href="./show_news?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m-d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
			<!--分页页号-->
			<div id="page_bar" style="top:0px;">
				<?php 
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./more_news.php?',$v,'">',$k,'</a>';
						}
					}
				?>
			</div>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
</html>