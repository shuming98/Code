<?php session_start();
require('../../lib/init.php');

//查询该学生的老师
if($_SESSION['permission_id']==3){
	$sql = "select teacher.user_account from user_data inner join teacher on user_data.class=teacher.t_class where user_data.user_account='$_SESSION[user_account]'";
	$teacher = mGetOne($sql);
}else if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){
	$teacher = $_SESSION['user_account'];
}

//输出目录名
$sql2 = "select dirname from study_dir where user_account = '$teacher'";
$dirname = mGetAll($sql2);

//输出文章
if(!isset($_GET['id'])){
	$sql3 = "select art_title,art_content,pubtime,pageview from article where dirname = 'default'";
	$article = mGetAll($sql3);
	$art_id=6;
	$sql4 = "update article set pageview=pageview+1 where art_id = $art_id";
	mQuery($sql4);
}else{
	$art_id = $_GET['id'];
	$sql5 = "select art_title,art_content,pubtime,pageview from article where art_id = $art_id";
	$article = mGetAll($sql5);
	$sql6 = "update article set pageview=pageview+1 where art_id = $art_id";
	mQuery($sql6);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../ueditor/utf8-php/ueditor.parse.min.js"></script>
	<script src="../../js/jquery.js"></script>
	<title>学习园地</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="study_container">
		<div class="study_container_left">
		<?php if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){?>
			<button id="add_dir_button" type="button">添加目录</button>
			<button type="button"><a href="./add_article.php">发布文章</a></button>
		<?php } ?>
			<div class="clearfix"></div>
			<p>知识树</p>
			<ul id="treeview">
				<?php foreach($dirname as $v){ ?>
				<li><span class="caret"><?php echo $v['dirname']; ?></span>
					<ul class="nested">
				<?php //输出文章标题
				$sql9 = "select art_id,art_title from article where dirname='$v[dirname]' order by art_id asc";
				$art_title = mGetAll($sql9);
				foreach($art_title as $v){
						echo '<li><a href="./study.php?id=',$v['art_id'],'">',$v['art_title'],'</a></li>';
				} ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="study_container_right">
			<h1><?php echo $article[0]['art_title']; ?></h1>
			<p><?php echo date('Y-m-d',strtotime($article[0]['pubtime'])); ?><span>阅读数：<?php echo $article[0]['pageview']; ?></span><?php if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){?><a href="./modify_article.php?art_id=<?php echo $art_id;?>">修改</a><?php } ?></p>
			<div class="clearfix"></div>
			<hr>
			<div id="art_content">
				<?php echo $article[0]['art_content']; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- 添加父节点-模态框 -->
	<div id="add_dir" class="modal">
		<div class="add_dir_content animate">
			<h1><img src="../../images/icon/work.png" alt="">添加目录</h1>
			<span id="add_dir_close" class="close">&times;</span>
		<form method="post">
			<input type="text" name="dirname" placeholder="目录名">
			<input type="submit" value="添加">
		</form>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/study.js"></script>
<script>
	uParse('#art_content', {
    rootPath: '../../ueditor/utf8-php/'
})
</script>
</html>