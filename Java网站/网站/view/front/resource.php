<?php session_start();
require('../../lib/init.php');
//资源标签
$sql = "select tag_id,tag_name from resource_tag";
$tag_name = mGetAll($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>课程资源</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!--课程资源-->
	<div class="resource_container">
	<!--资源下载-->
		<div class="resource_show">
			<span>当前位置:JAVA课程资源&gt;教学文档</span>
			<figure>
				<a href="#">
				<img src="../../images/icon/study.png" alt="">
				<figcaption>实验报告</figcaption>	
				</a>
			</figure>
		</div>
	<!--资源分类-->
		<div class="resource_select">
			<button type="button" onclick="document.getElementById('upload_resource').style.display='block'">+发布资源</button>
			<button type="button" onclick="document.getElementById('add_tag').style.display='block'">+添加分类</button>
			<div class="resource_category">
				<p><img style="width: 20px;" src="../../images/icon/about.png" alt="">资源分类</p>
				<ul>
<?php foreach($tag_name as $v){ ?>
					<li><a href="./resource.php?tag_id=<?php echo $v['tag_id']; ?>"><?php echo $v['tag_name']; ?></a></li>
<?php } ?>
				</ul>
			</div>
			<div class="clearfix"></div>

	<!--资源推荐-->
			<div class="resource_recom">
				<p><img style="width: 20px;" src="../../images/icon/about.png" alt="">推荐资源</p>
				<ul>
					<li><a href="">火星版编译软件下载</a></li>
					<li><a href="">参考手册</a></li>
					<li><a href="">函数手册</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<!--上传资源-模态框-->
	<div id="upload_resource" class="modal">
		<div class="upload_modal_content animate">
			<h1><img src="../../images/icon/work.png" alt="">上传课程资源</h1>
			<span onclick="document.getElementById('upload_resource').style.display='none'" class="close">&times;</span>
		<form action="../admin/upload_resource.php" method="post" enctype="multipart/form-data">
			<p>资源标题:<input type="resource_name" name="title"></p>
			<p>资源分类:
				<select name="tag_name">
<?php foreach($tag_name as $v){ ?>
				<option value="<?php echo $v['tag_name']; ?>"><?php echo $v['tag_name']; ?></option>
<?php } ?>
				</select>
			</p>
			<p>文件上传:<input name="resource" type="file"></p>
			<p><input type="submit" value="上传"></p>
		</form>
		</div>
	</div>

<!--添加标签-模态框-->
	<div id="add_tag" class="modal">
		<div class="add_tag_content animate">
			<h1><img src="../../images/icon/work.png" alt="">添加资源分类<span>(最多可添加5个)</span></h1>
			<span onclick="document.getElementById('add_tag').style.display='none'" class="close">&times;</span>
		<form action="../admin/add_tag.php" method="post">
			<input type="text" name="tag_name" placeholder="请输入资源类名">
			<input type="submit" value="添加">
		</form>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>