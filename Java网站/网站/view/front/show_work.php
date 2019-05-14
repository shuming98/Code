<?php 
session_start(); 
require('../../lib/acc_user.php');
require('../../lib/init.php');
//查看学生昵称和班级
$sql = "select user_nick,class from user_data where user_account='$_SESSION[user_account]'";
$student = mGetAll($sql);
$class = $student[0]['class'];

/**
 * 实现分页功能
 */

//查看学生作业数量
$sql2 = "select count(*) from issue_work where class='$class'";
$work_sum = mGetOne($sql2);

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示工作数量
$per_page_num = 3;

//查看学生作业
$sql3= "select issue_work.work_id,work_title,issue_work.work_content,issue_work.work_filepath,deadline,score,comment,submit_date from issue_work left join submit_work on issue_work.work_id=submit_work.work_id where class='$class' order by issue_work.work_id desc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
$work = mGetAll($sql3);

$pages = getPage($work_sum,$current_page,$per_page_num);

//查看学生成绩
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>查看作业</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<!--学生查看作业-->
	<div class="show_work_container">
		<p><?php echo $student[0]['user_nick']; ?>，你好，Today is	<?php echo date(D); ?></p>
		<p>作业&gt;<a href="./show_work.php" style="color:#26A5FF">查看作业</a>&gt;<a href="./show_grade.php">查看成绩</a></p>
		<div class="adjust_pos">
	<?php foreach($work as $v){ ?>		
		<div class="show_work_content">
			<button type="button" onclick="document.getElementById('show_work_<?php echo $v['work_id']; ?>').style.display='block'">查看</button>
			<h2>&gt;<?php echo $v['work_title']; ?></h2>
			<p>截止日期：	<?php echo $v['deadline']; ?></p>
			<p>上一次提交时间：<?php echo $v['submit_date']; ?></p>
			<p>得分：<?php echo $v['score']; ?></p>
			<p>评语：<?php echo $v['comment']; ?></p>
		</div>
		<div class="clearfix"></div>
	<?php } ?>
		</div>
	<!--分页页号-->
		<div id="page_bar" style="top:0px;">
			<?php 
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./show_work.php?',$v,'">',$k,'</a>';
					}
				}
			?>
		</div>
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
		<?php //超过截止时间不允许提交作业
			if(time()<strtotime($v[deadline])){ ?>
			<form id="submit_work_<?php echo $v['work_id']; ?>" class="submit_form" method="post" enctype="multipart/form-data" data-workid="<?php echo $v['work_id']; ?>">
				<p>提交文本答案:</p>
				<textarea name="work_content"></textarea>
				<p>上传文件:<input type="file" name="work"></p>
				<input type="submit" value="提交">
			</form>
	<?php }else{ ?>
		<p class="overtime">已过作业提交的截止时间,无法提交</p>
	<?php } ?>
		</div>
	</div>
<?php } ?>
	<?php include('./foot.html'); ?>
</body>
<script src=""></script>
<script>
$(".submit_form").submit(function(){
	var that = this;
	var form_data = new FormData($(that)[0]);
	$.ajax({
	    url: "../admin/submit_work.php?work_id="+$(that).data('workid'),
	    type: "post",
	    data: form_data,
	    processData: false,
	    contentType: false,
	    success:function(data){
	        alert(data);
	        location.reload();
	    },	
	    error:function(data){
	        alert('发布失败');
	    			}
		});
		return false;
});
</script>
</html>