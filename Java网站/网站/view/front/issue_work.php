<?php 
session_start(); 
require('../../lib/init.php');
$sql = "select t_class from teacher where user_account='$_SESSION[user_account]'";
$work_class = mGetAll($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>Document</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="issue_container">

		<p>老师好，当前时间<span id="show_time"></span></p>
		<p>作业&gt;<a href="./issue_work.php" style="color:#26A5FF;">发布作业</a>&gt;<a href="./check_work.php">批改作业</a></p>

		<form id="issue_work" name="work_date" method="post" enctype="multipart/form-data">
			<p>标题：<input type="text" name="work_title"></p>
			<p>作业内容：</p>
			<textarea name="work_content"></textarea>
			<p>文件上传：<input name="work" type="file"></p>
			<p>截止日期： 
				<select name="YYYY" onchange="YYYYDD(this.value)"></select>
    			<select name="MM" onchange="MMDD(this.value)"></select>
    			<select name="DD"><option value="">选择 日</option></select>
    			<span>(默认时间:23:59:59)</span>
    		</p>
			<p>选择班级：<select name="class">
<?php foreach($work_class as $v){ ?>
				<option value="<?php echo $v['t_class']; ?>"><?php echo $v['t_class']; ?></option>
<?php } ?>
			</select></p>
			<input type="submit" value="发布">
		</form>

	</div>
	<?php include('foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="../../js/select_date.js" type="text/javascript" charset="utf-8"></script>
<script>
	window.onload = startClock();
</script>
</html>