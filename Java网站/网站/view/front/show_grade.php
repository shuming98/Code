<?php 
session_start(); 
require('../../lib/init.php');

//查询学生名字
$sql = "select user_nick from user_data where user_account='$_SESSION[user_account]'";
$student = mGetAll($sql);

//查询学生成绩
$sql2 = "select work_title,submit_date,score,comment from submit_work inner join issue_work on issue_work.work_id=submit_work.work_id where submit_work.user_account='$_SESSION[user_account]' order by issue_work.work_id desc";
$grade = mGetAll($sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>查看成绩</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="show_grade_container">
		<p><?php echo $student[0]['user_nick']; ?>，你好，Today is <?php echo date(D); ?></p>
		<p class="show_grade_nav">作业&gt;<a href="./show_work.php">查看作业</a>&gt;<a href="./show_grade.php" style="color:#26A5FF">查看成绩</a></p>
		<table>
			<tr>
				<th>作业标题</th>
				<th>作业提交时间</th>
				<th>成绩</th>
				<th>评语</th>
			</tr>
<?php foreach($grade as $v){ ?>
			<tr>
				<td><?php echo $v['work_title']; ?></td>
				<td><?php echo date('Y-m-d',strtotime($v['submit_date'])); ?></td>
				<td><?php echo $v['score']; ?></td>
				<td><?php echo $v['comment']; ?></td>
			</tr>
<?php } ?>	
		</table>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>