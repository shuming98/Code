<?php 
session_start(); 
require('../../lib/acc_teacher.php');
require('../../lib/init.php');
$sql = "select t_class from teacher where user_account='$_SESSION[user_account]'";
$work_class = mGetAll($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<script src="../../js/jquery.js"></script>
	<title>发布作业</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="issue_container">
	<div class="work_line">	
		<span class="work_nav"><span>作业</span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./issue_work.php">发布作业</a></span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./check_work.php">批改作业</a></span></span><span class="work_tri"></span>
	</div>
	<div class="clearfix"></div>
	<div class="feature_pic" style="top:40px;right:30px;">		
		<img src="../../images/icon/work-white.png" alt="work">	
	</div>			
	<div class="issue_form_container">
		<div class="issue_form_top">
			<span></span>
			<img src="../../images/icon/clock.png" alt="clock">
			<span class="show_time">当前时间<span id="show_time"></span></span>
		</div>
		<form id="issue_work" name="work_date" method="post" enctype="multipart/form-data">
			<p>标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题：<input type="text" name="work_title" required="required"></p>
			<div class="clearfix"></div>
			<p>作业内容：</p>		
			<textarea name="work_content"></textarea>
			<p>上传文件：<input name="work" type="file"></p>
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
	</div>
	<?php include('foot.html'); ?>
</body>
<script src="../../js/issue_work.js"></script>
<script src="../../js/select_date.js"></script>
</html>