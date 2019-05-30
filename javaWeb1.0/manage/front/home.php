<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');
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
	<title>首页</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="home_container">
				<h2 class="h2_title">注意事项</h2>
				<span class="h2_line"></span>
				<div class="warning">
					<img src="../../images/icon/warning.png" alt="warn">
					<h2>数据无价！</h2>
					<div class="clearfix"></div>
					<p>实行”删除”操作前</p>
					<p>三思而后行</p>
				</div>
				<ul>
					<li>1.权力越大，责任越大。你在这所执行的操作，会直接影响整个网站。</li>
					<li>2.轮播图显示最新发布的前五张图片(尺寸：宽 / 高 ≈ 1.78)。</li>
					<li>3.首页三个模块可修改名字、发布文章或引入链接。</li>
					<li>4.优秀师生显示最新发布的前三张图片。</li>
					<li>5.请先添加老师账号，再添加班级。一个班级只能由一位老师任教(单指Java这门课)，一个老师可任教多个班级。</li>
					<li>	6.删除”资源分类”、”目录摘要”、”作业发布”，会把属于它的数据(课程资源、文章等)全部删掉。</li>
				</ul>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
</html>