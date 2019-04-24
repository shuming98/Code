<?php 
session_start(); 
require('../../lib/init.php');
//查询该老师任课班级
$sql = "select t_class from teacher where user_account = '$_SESSION[user_account]'";
$class = mGetAll($sql);

//格式化时间
$format_date = $_GET['YYYY'].'-'.$_GET['MM'].'-'.$_GET['DD'];
$issue_date = date('Y-m-d',strtotime($format_date));

$issue_class = $_GET['class'];

//查询当天发布作业的id及内容
$sql2 = "select work_id,work_title,deadline from issue_work where date_format(issue_date,'%Y-%m-%d')='$issue_date' and class='$issue_class'";
$issue_work = mGetAll($sql2);

//多作业查询
if(isset($_GET['key'])){
$work_id = $issue_work[$_GET['key']]['work_id'];
$work_title = $issue_work[$_GET['key']]['work_title'];
$work_deadline = $issue_work[$_GET['key']]['deadline'];
}else{
	$work_id = $issue_work[0]['work_id'];
	$work_title = $issue_work[0]['work_title'];
	$work_deadline = $issue_work[0]['deadline'];
}

//查询学生提交的作业内容
$sql3 = "select user_id,nt.user_account,user_nick,work_id,work_content,work_filepath,score from (select user_id,user_data.user_account,user_nick from user_data inner join user on user_data.user_account=user.user_account where user_data.class='$issue_class') as nt left join (select user_account,work_id,work_content,work_filepath,score from submit_work where work_id=$work_id) as nt2 on nt.user_account=nt2.user_account order by nt.user_id asc";
$student_work = mGetAll($sql3);

//统计已提交作业人数
$sql4 = "select count(*) from (select user_data.user_account,user_nick from user_data inner join user on user_data.user_account=user.user_account where user_data.class='$issue_class') as nt left join (select user_account,work_id from submit_work where work_id=$work_id) as nt2 on nt.user_account=nt2.user_account where work_id=$work_id";
$submit_num = mGetOne($sql4);

//统计没提交作业人数
$sql5 = "select count(*) from (select user_data.user_account,user_nick from user_data inner join user on user_data.user_account=user.user_account where user_data.class='$issue_class') as nt left join (select user_account,work_id from submit_work where work_id=$work_id) as nt2 on nt.user_account=nt2.user_account where work_id is NULL";
$nosubmit_num = mGetOne($sql5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>批改作业</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="check_container">
		<!--查询作业-->
		<div class="select_form">
			<p>老师好，当前时间<span id="show_time"></span></p>
			<p style="float:left">作业&gt;<a href="./issue_work.php">发布作业</a>&gt;<a href="./check_work.php" style="color:#26A5FF">批改作业</a></p>
			<div class="clearfix"></div>
			<form name="work_date" method="get">
				<span>班级:</span>
				<select name="class" id="class">
			<?php //输出班级
			foreach($class as $v){ 
				echo '<option value="',$v['t_class'],'">',$v['t_class'],'</option>';
				} ?>
				</select>
				<span>作业发布时间:</span>
				<select name="YYYY" onchange="YYYYDD(this.value)"></select>
    			<select name="MM" onchange="MMDD(this.value)"></select>
    			<select name="DD"><option value="">选择 日</option></select>
				<input type="submit" value="确定">
			</form>
		</div>
		<div class="clearfix"></div>
		<!--显示查询结果-->
		<div class="select_result">
			<?php //显示班级和日期 
			if(count($issue_work)==0){
				echo '<p id="check_p">这一天并没有发布作业!!!</p>';
			}else if(count($issue_work)==1){
				echo '<p>当前班级&gt;',$issue_class,'&gt;',$issue_date,'</p>';
			}else if(count($issue_work)>1){
				echo '<span class="works_span">你在当天发布了',count($issue_work),'次作业，请选择作业编号:</span>';
				foreach($issue_work as $k=>$v){
					$_GET['key']=$k;
					echo '<a class="select_works" href="./check_work.php?',http_build_query($_GET),'">',$v['work_id'],'</a>';
				}
				echo '<p>当前班级&gt;',$issue_class,'&gt;',$issue_date,'&gt;',$work_id,'</p>';
			}
			?>
			<table>
				<tr>
					<th>学号</th>
					<th>姓名</th>
					<th>作业情况</th>
					<th>成绩</th>
				</tr>
<?php //输出学生作业
		foreach($student_work as $v){ ?>
				<tr>
					<td><?php echo $v['user_account']; ?></td>
					<td><?php echo $v['user_nick']; ?></td>
					<td><?php if($v['work_id']!=NULL){ ?><a onclick="document.getElementById('check_work_<?php echo $v['user_id']; ?>').style.display='block'">已交</a><?php }else{echo '<span class="no_submit">未交<span>';} ?></td>
					<td id="s_<?php echo $v['user_id']; ?>"><?php echo $v['score']; ?></td>
				</tr>
<?php } ?>
			</table>
			<?php echo '<p>本次作业：',$submit_num,'人已交,',$nosubmit_num,'人未交</p>'; ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<!--显示学生作业_模态框-->
<?php foreach($student_work as $v){ ?>
	<div id="check_work_<?php echo $v['user_id']; ?>" class="modal">
		<div class="check_modal_content animate">
			<div class="check_modal_head">
				<p>正在批改&gt;<?php echo $issue_class,"&gt",'<b>',$v['user_nick'],'</b>'; ?></p>
				<span class="close" onclick="document.getElementById('check_work_<?php echo $v['user_id']; ?>').style.display='none'">&times;</span>
			</div>
			<div class="check_modal_issue_work">
				<?php echo '<p>作业标题:',$work_title,'</p>','<p>截止日期:',$work_deadline,'</p>'; ?>
			</div>
			<h2><?php echo $v['user_nick']; ?>提交的作业:</h2>
			<div class="check_modal_submit_work">
			<p>文本内容:</p>
			<pre><?php echo $v['work_content']; ?></pre>
			<?php if(!empty($v['work_filepath'])){ ?>
				<p>文件:<a class="d_file" href="<?php echo '../..'.$v['work_filepath'];?>">下载&nbsp;<?php echo getFileName($v['work_filepath']); ?></a></p>
			<?php } ?>
			</div>
			<form id="check_form_<?php echo $v['user_id']; ?>" action="" method="post" accept-charset="utf-8">
				<p>成绩：<input type="text" name="score" placeholder="请输入该作业得分"></p>
				<p>评语：<input type="text" name="comment"></p>
				<input type="submit" value="确定">
				<div class="clearfix"></div>
			</form>
		</div>
<script>
$("#check_form_<?php echo $v['user_id']; ?>").submit(function(){

 	var data={'score':$("#check_form_<?php echo $v['user_id']; ?> input[name='score']").val(),
   'comment':$("#check_form_<?php echo $v['user_id']; ?> input[name='comment']").val()};

 $.post('../admin/check_work.php?user_account=<?php echo $v['user_account']; ?>&work_id=<?php echo $v['work_id'];?>',data,function(res){alert(res);$("#check_work_<?php echo $v['user_id']; ?>").css('display','none');$("#s_<?php echo $v['user_id']; ?>").text(eval(data)['score']);});
 return false;
 });

</script>
	</div>
<?php } ?>
	<!--页尾-->
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
<script src="../../js/select_date.js" type="text/javascript" charset="utf-8"></script>
<script>
	window.onload=startClock();
</script>
</html>