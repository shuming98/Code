<?php session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//查询该学生的老师
if($_SESSION['permission_id']==3){
	$sql = "select teacher.user_account from user_data inner join teacher on user_data.class=teacher.t_class where user_data.user_account='$_SESSION[user_account]'";
	$teacher = mGetOne($sql);
}else if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){
	$teacher = $_SESSION['user_account'];
}

//输出目录名
$sql2 = "select dirname_id,dirname from study_dir where user_account = '$teacher'";
$dirname = mGetAll($sql2);

//获取用户ip并记录浏览数	
$pageview['ip'] = sprintf('%u',ip2long(getRealIp()));

//输出文章
if(!isset($_GET['id'])){
	$sql3 = "select art_title,art_content,pubtime from article where dirname_id = 0  and user_account='$teacher'";
	$article = mGetAll($sql3);

	if(!empty($article)){
	$sql4 = "select art_id from article where dirname_id = 0 and user_account='$teacher'";
	$art_id = mGetOne($sql4);

	//记录浏览数
	$pageview['symbol'] = "art_$art_id";

	//显示阅读数
	$sql5 = "select count(*) from pageview where symbol = 'art_$art_id'";
	$viewsum = mGetOne($sql5);
	}
}else{
	$art_id = $_GET['id'];
	$sql6 = "select art_title,art_content,pubtime from article where art_id = $art_id";
	$article = mGetAll($sql6);

	//记录浏览数
	$pageview['symbol'] = "art_$art_id";

	//显示阅读数
	$sql7 = "select count(*) from pageview where symbol = 'art_$art_id'";
	$viewsum = mGetOne($sql7);

	//防止用户乱输入url
	if(empty($article)){
		header('Location:../../404.html');
		exit;
	}
}

//浏览数+1
$sql8 = "select count(*) from pageview where symbol = '$pageview[symbol]' and ip = $pageview[ip]";
if(mGetOne($sql8) == 0){
	mExec('pageview',$pageview);
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
	<script src="../../js/jquery.js"></script>
	<title>学习园地</title>
</head>
<body style="background: #F0F0F0">
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="study_container">
		<div class="study_container_left">
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){?>
			<div class="study_button">
				<button type="button" onclick="location.href='./add_article.php'"><img src="../../images/icon/add-article.png" alt="article">发布文章</button>
				<button id="add_dir_button" type="button"><img src="../../images/icon/modal-dir.png" alt="dir">添加目录</button>
				<div class="clearfix"></div>	
			</div>
		<?php } ?>
			<p>知识树</p>
			<ul id="treeview">
				<?php foreach($dirname as $v){ ?>
				<li class="treeview_li"><span class="caret"><span>&nbsp;&nbsp;</span><span><?php echo $v['dirname']; ?></span></span>
					<ul class="nested">
				<?php //输出文章标题
				$sql9 = "select art_id,art_title from article where dirname_id='$v[dirname_id]' order by art_id asc";
				$art_title = mGetAll($sql9);
				foreach($art_title as $v){
						echo '<li><span class="li_dot">&#8226;</span><a href="./study.php?id=',$v['art_id'],'">',$v['art_title'],'</a></li>';
				} ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="study_container_right">
		<?php if(empty($article)){
			echo '<h1>默认页面,教师还未编写<br/>教师可编写默认页面内容至‘选择目录’</h1>';
		}else{ ?>
			<h1><?php echo $article[0]['art_title']; ?></h1>
			<p><?php echo date('Y-m-d',strtotime($article[0]['pubtime'])); ?><span>阅读数：<?php echo $viewsum;?>		</span><?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){?><a href="./modify_article.php?art_id=<?php echo $art_id;?>">修改</a><?php } ?></p>
			<div class="clearfix"></div>
			<hr>
			<div id="art_content">
				<?php echo $article[0]['art_content']; ?>
			</div>
		<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- 添加父节点-模态框 -->
	<div id="add_dir" class="modal">
		<div class="add_dir_content animate">
			<h1 class="modal_title"><img src="../../images/icon/modal-dir.png" alt="dir">添加目录</h1>
			<span id="add_dir_close" class="close">&times;</span>
		<form method="post">
			<input type="text" name="dirname" placeholder="目录名" maxlength="20" required="required">
			<input type="submit" value="添加">
		</form>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/study.js"></script>
</html>