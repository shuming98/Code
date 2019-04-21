<?php session_start(); 
require('../../lib/init.php');

//查看学生昵称和班级
$sql = "select user_nick,class from user_data where user_account='$_SESSION[user_account]'";
$student = mGetAll($sql);
$class = $student[0]['class'];

//查看学生作业
$sql2 = "select work_id,work_title,work_content,work_filepath,deadline from issue_work where class='$class'";
$work = mGetAll($sql2);
var_dump($work);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>查看作业</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<!--学生查看作业-->
	<div class="show_work_container">
		<p><?php echo $student[0]['user_nick']; ?>，你好，Today is	<?php echo date(D); ?></p>
		<p>作业&gt;<a href="./show_work.php" style="color:#26A5FF">查看作业</a>&gt;<a href="./show_grade.php">查看成绩</a></p>
	
<?php foreach($work as $v){ ?>		
		<div class="show_work_content">
			<button type="button" onclick="document.getElementById('show_work_<?php echo $v['work_id']; ?>').style.display='block'">查看</button>
			<h2>&gt;<?php echo $v['work_title']; ?></h2>
			<p>截止日期：	<?php echo $v['deadline']; ?></p>
			<p>上一次提交时间：2019/4/29 16:42:36</p>
			<p>得分：4.0</p>
			<p>评语：很好</p>
		</div>
		<div class="clearfix"></div>
<?php } ?>
	</div>

	<!--查看作业模态框-->
<?php foreach($work as $v){ ?>
	<div id="show_work_<?php echo $v['work_id'];?>" class="modal">
		<div class="show_modal_content animate">
			<span class="close" onclick="document.getElementById('show_work_<?php echo $v['work_id'];?>').style.display='none'">&times;</span>
			<h2>&gt;<?php echo $v['work_title']; ?></h2>
			<p><pre><?php echo $v['work_content']; ?></pre></p>
<?php if(!empty($v['work_filepath'])){ ?>
			<p>作业文件：<a class="a_blue" href="<?php echo '../..'.$v['work_filepath']; ?>" download>点击下载</a></p>
<?php } ?>
			<form action="#" method="get" accept-charset="utf-8" enctype="multipart/form-data">
				<p>提交文本答案:</p>
				<textarea name=""></textarea>
				<p>上传文件:<input type="file" name=""></p>
				<input type="submit" name="" value="提交">
			</form>
		</div>
	</div>
<?php } ?>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>