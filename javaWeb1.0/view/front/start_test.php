<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');


if(isset($_GET['test_id'])){
	$test_id = $_GET['test_id'];

	//输出该题标题
	$sql = "select title from test where test_id=$test_id";
	$title = mGetOne($sql);

	//输出该题库
	$sql2 = "select question,A,B,C,D,answer from choice_test where test_id=$test_id order by id asc";
	$topic = mGetAll($sql2);

	//初始题号
	$num = 1;

	$sql3 = "select count(*) from test inner join (select teacher.user_account from user_data inner join teacher on user_data.class=teacher.t_class where user_data.user_account='$_SESSION[user_account]') as t on test.user_account=t.user_account and test_id=$test_id";	
	if(mGetOne($sql3) == 0){
		header('Location:../../404.html');
		exit;
	}
}else{
	header('Location:../../404.html');
	exit;
}

if(!empty($_POST)){
	//初始分数
	$score = 0;
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
 	<title><?php echo $title; ?></title>
 </head>
 <body>
 	<?php include('./nav.php'); ?>
 	<div class="start_test_container">
 		<div class="test_content">
 			<h2><?php echo $title; ?></h2>
 			<div class="topic_num">
 			<?php for($i = 1;$i<=count($topic);$i++){
 				echo '<span class="number" onclick="currentNum(',$i,')">',$i,'</span>';
 			} ?>
 			</div>
 			<form method="post" action="">
 				<?php foreach($topic as $v){ ?>
 					<div class="one_topic">
 					<div style="height:250px;">
 					<p><?php echo $num++,'.&nbsp;',htmlspecialchars($v['question'],ENT_QUOTES); ?></p>
 					<label><input type="radio" name="topic_<?php echo $num-1; ?>" value="A">A.&nbsp;<?php echo htmlspecialchars($v['A'],ENT_QUOTES); ?></label>
 					<label><input type="radio" name="topic_<?php echo $num-1; ?>" value="B">B.&nbsp;<?php echo htmlspecialchars($v['B'],ENT_QUOTES); ?></label>
 					<label><input type="radio" name="topic_<?php echo $num-1; ?>" value="C">C.&nbsp;<?php echo htmlspecialchars($v['C'],ENT_QUOTES); ?></label>
 					<label><input type="radio" name="topic_<?php echo $num-1; ?>" value="D">D.&nbsp;<?php echo htmlspecialchars($v['D'],ENT_QUOTES); ?></label>
 					</div>
 				<?php if(!empty($_POST)){ ?>
 					<div class="answer_topic">
 					<?php
 						echo '<p><span>你的答案：<span>',$_POST[topic_.($num-1)],'</span></span><span>正确答案：<span>',$v['answer'];
 						if($_POST[topic_.($num-1)] == $v['answer']){
							echo '</span></span><span>当前得分：<span>',$score += 2,'</span></span>';
						}else{
							echo '</span></span><span>当前得分：<span>',$score,'</span></span>';
					}?>
					</p>
 					</div>
 				<?php } ?>
 				</div>
 				<?php } ?>
 				<div class="topic_btn">
 					<button type="button" id="next" onclick="changeTopic(1)">下一题</button>	
 					<button type="button" id="prev" onclick="changeTopic(-1)">上一题</button>
 				<?php if(empty($_POST)){ ?>
 				<input id="submit_topic" type="submit" value="提交">
 				<?php } ?>
 				<div class="clearfix"></div>
 				</div>
 			</form>
 		</div>
 	</div>
 	<?php include('./foot.html'); ?>
 </body>
 <script>
//初始化题号
var topicNum = 1;
showTopic(topicNum);

//更换题目
function changeTopic(n){
	showTopic(topicNum += n);
}

//显示当前题号题目
function currentNum(n){
	showTopic(topicNum = n);
}

//显示题目
function showTopic(n){
 	var i;
 	var topics = document.getElementsByClassName("one_topic");
 	var numbers = document.getElementsByClassName("number");

 	//初始化题目
 	for(i = 0; i < topics.length; i++){
 		topics[i].style.display = "none";
 	}

 	//初始化题号样式
 	for(i = 0; i < numbers.length; i++){
 		numbers[i].className = numbers[i].className.replace(" num_active","");
 	}

 	//显示题目和改变该题号样式
 	topics[topicNum-1].style.display = "block";
 	numbers[topicNum-1].className += " num_active";

 	//隐藏上一题按钮
 	if(n == 1){
 		document.getElementById("prev").style.display = "none";
 	}else{
 		document.getElementById("prev").style.display = "block";
 	}

 	//隐藏下一题按钮
 	if(n == topics.length){
 		document.getElementById("next").style.display = "none";
 	<?php if(empty($_POST)){ ?>
 		document.getElementById("submit_topic").style.display = "block";
 	<?php } ?>
 	}else{
 		document.getElementById("next").style.display = "block";
 	<?php if(empty($_POST)){ ?>
 		document.getElementById("submit_topic").style.display = "none";
 	<?php } ?>
 	}
 }
 </script>
 </html>