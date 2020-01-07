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
$sql3= "select issue_work.work_id,work_title,issue_work.work_content,issue_work.work_filepath,deadline,submit_date,score,comment from issue_work left join (select work_id,submit_date,score,comment from submit_work where user_account='$_SESSION[user_account]') as t on issue_work.work_id=t.work_id where class='$class' order by issue_work.work_id desc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
$work = mGetAll($sql3);

$pages = getPage($work_sum,$current_page,$per_page_num);

//防止用户乱输入url
if(empty($work) && isset($_GET['page'])){
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
	<script src="../../js/jquery.js"></script>
	<title>查看作业</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<!--学生查看作业-->
	<div class="show_work_container">
	<div class="work_line">	
		<span class="work_nav"><span>作业</span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./show_work.php">查看作业</a></span></span><span class="work_tri"></span><span class="work_nav2"><span><a href="./show_grade.php">查看成绩</a></span></span><span class="work_tri"></span>
	</div>
	<div class="clearfix"></div>
	<span class="work_calen" style="margin-top:21px;"><img src="../../images/icon/calen.png" alt="calen"><?php echo $student[0]['user_nick']; ?>,Today is <span><?php echo date(D); ?></span></span>	
	<div class="clearfix"></div>
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
	<div style="background: #DEDEDE;padding:2px 0px;width:1100px;margin:auto">
		<div id="page_bar" style="top:0px;">
			<?php 
			if($current_page>1){
					$_GET['page']=$current_page-1;
					echo '<a class="page_symbol" href="./show_work.php?',http_build_query($_GET),'">&lt;</a>';
			}
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./show_work.php?',$v,'">',$k,'</a>';
					}
				}
			end($pages);
			if($current_page<key($pages)){
				$_GET['page']=$current_page+1;
				echo '<a class="page_symbol" href="./show_work.php?',http_build_query($_GET),'">&gt;</a>';
			}
			?>
		</div>
	</div>
	</div>
	<!--查看作业模态框-->
<?php foreach($work as $v){ ?>
	<div id="show_work_<?php echo $v['work_id'];?>" class="modal">
		<div class="show_modal_content animate">
			<span class="close close_circle" style="top:10px" onclick="document.getElementById('show_work_<?php echo $v['work_id'];?>').style.display='none'">&times;</span>
			<h1 class="modal_radius">提交作业</h1>
			<h2><?php echo $v['work_title']; ?></h2>
			<div class="feature_pic2" style="background: #DE6565;left:40px;top:30px;">	
				<img src="../../images/icon/Q.png" alt="Q">	
			</div>
			<div class="show_work_question">
			<?php 
				if(strlen($v['work_content']) > 300){
					echo '<pre style="text-align:left">',$v['work_content'],'</pre>';
				}else{
					echo '<pre>',$v['work_content'],'</pre>';
				}
			?>			
				<?php if(!empty($v['work_filepath'])){ ?>
				<p>作业文件：<a class="a_blue" href="<?php echo '../..'.$v['work_filepath']; ?>" download>点击下载</a></p>
				<?php } ?>
			</div>
		<?php //超过截止时间不允许提交作业
			if(time() < strtotime($v[deadline])){ ?>
			<form id="submit_work_<?php echo $v['work_id']; ?>" class="submit_form" method="post" enctype="multipart/form-data" data-workid="<?php echo $v['work_id']; ?>">
			<div class="feature_pic2" style="background: #5D82CC;right:30px;top:30px;">	
				<img src="../../images/icon/A.png" alt="A">	
			</div>
				<textarea name="work_content" placeholder="提交文本答案区域"></textarea>
			<div class="feature_pic2" style="background: #78E091;right:30px;margin-bottom:-50px">
				<img src="../../images/icon/upload-work.png" alt="upload">	
			</div>
				<p class="up_work_file">上传文件：<input type="file" name="work"></p>
				<input type="submit" value="提交">
				<div class="clearfix"></div>
			</form>
	<?php }else{ ?>
		<p class="overtime">已过截止时间,无法提交</p>
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