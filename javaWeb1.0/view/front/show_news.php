<?php 
session_start(); 
require('../../lib/init.php');

if(isset($_GET['id'])){
	//查询该文章内容
	$sql2 = "select title,cat_name,content,pubtime from home_news inner join news_cat on news_cat.id=home_news.cat_id where home_news.id=$_GET[id]";
	$news = mGetAll($sql2);

	if(empty($news)){
		header('Location:../../404.html');
		exit;
	}
}else{
	header('Location:../../404.html');
	exit;
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
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title><?php echo $news[0]['title']; ?></title>
</head>
<body>
<div class="header_pic">
	<div>
		<img class="header_logo" src="../../images/icon/logo.png" alt="logo">
	</div>
</div>
	<!--导航栏-->
<div class="nav_bg">	
	<div class="nav">
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
			<li><a href="./t_test.php"><img src="../../images/icon/test.png" alt="test">发布试题</a></li>
		<?php }else{ ?>
			<li><a href="./s_test.php"><img src="../../images/icon/test.png" alt="test">试题练习</a></li>
		<?php } ?>	
			<li><a href="./forum.php"><img src="../../images/icon/forum.png" alt="forum">讨论区</a></li>
		</ul>
	</div>
</div>
	<div class="clearfix"></div>
	<div class="news_container">
		<h1><?php echo $news[0]['title']; ?></h1>
		<p class="news_data"><?php echo date('m-d',strtotime($news[0]['pubtime'])),'&nbsp;&nbsp;',$news[0]['cat_name']; ?>
		<?php 
			if (!empty($_SESSION) && ($_SESSION['permission_id']==1)){
				echo '<a class="news_modify" href="./modify_news.php?id=',$_GET[id],'">修改</a>';
			}
		 ?>
		</p>
		<hr>
		<?php echo $news[0]['content']; ?>
	</div>
	<?php include('./foot.html'); ?>
</body>
</html>