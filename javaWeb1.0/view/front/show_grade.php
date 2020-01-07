<?php 
session_start(); 
require('../../lib/acc_user.php');
require('../../lib/init.php');

//查看该学生班级
$sql = "select class from user_data where user_account='$_SESSION[user_account]'";
$class = mGetOne($sql);

/**
 * 实现分页功能
 */
//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 10;

//查询学生名字
$sql2 = "select user_nick from user_data where user_account='$_SESSION[user_account]'";
$student = mGetAll($sql2);

//查询学生成绩
$sql3 = "select issue_work.work_id,work_title,submit_date,score,comment from submit_work inner join issue_work on issue_work.work_id=submit_work.work_id where submit_work.user_account='$_SESSION[user_account]' and class='$class' order by issue_work.work_id desc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
$grade = mGetAll($sql3);

$sql4 = "select count(*) from submit_work inner join issue_work on issue_work.work_id=submit_work.work_id where submit_work.user_account='$_SESSION[user_account]' and class='$class' order by issue_work.work_id desc";
$num = mGetOne($sql4);

$pages = getPage($num,$current_page,$per_page_num);

if(empty($grade) && isset($_GET['page'])){
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
	<title>查看成绩</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="show_grade_container">
	<div class="work_line">	
		<span class="work_nav"><span>作业</span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./show_work.php">查看作业</a></span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./show_grade.php">查看成绩</a></span></span><span class="work_tri"></span>
	</div>
	<div class="clearfix"></div>
		<div class="show_grade_table">
		<span class="work_calen"><img src="../../images/icon/calen.png" alt="calen"><?php echo $student[0]['user_nick']; ?>,Today is <span><?php echo date(D); ?></span></span>	
		<div class="clearfix"></div>
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
			<!--分页页号-->
			<div id="page_bar" style="top:0px;">
				<?php 
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span class="page_dot">',$k,'</span>';
						}else{
							echo '<a href="./show_grade.php?',$v,'">',$k,'</a>';
						}
					}
				?>
			</div>
	</div>
</div>
	<?php include('./foot.html'); ?>
</body>
</html>