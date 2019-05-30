<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');

//查询该老师添加的试题
$sql = "select test_id,title from test where user_account = '$_SESSION[user_account]'";
$title = mGetAll($sql);

//防止用户乱输入url
if(isset($_GET['test_id'])){
	$sql6 = "select count(*) from choice_test inner join test on choice_test.test_id=test.test_id where choice_test.test_id=$_GET[test_id] and user_account='$_SESSION[user_account]'";
	if(mGetOne($sql6) == 0){
		header('Location:../../404.html');
		exit;
	}

	//输出此测试标题
	$sql7 = "select title from test where test_id=$_GET[test_id]";
	$one_title = mGetOne($sql7);

	//题目浏览
	$sql2 = "select question,A,B,C,D,answer from choice_test where test_id=$_GET[test_id] order by id asc";
	$test = mGetAll($sql2);
}

//给试题编号初始化
$num = 1;
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
	<title>查看试题</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="test_container">
		<div class="test_left">
			<a href="./add_test.php"><img src="../../images/icon/add_test.png" alt="add_test">添加试题</a>
			<div class="test_title_list">
				<h3>已添加试题</h3>	
				<ul>
				<?php foreach($title as $v){
					echo '<li><span class="li_dot">&#8226;</span><a href="./t_test.php?test_id=',$v['test_id'],'">',$v['title'],'</a></li>';
				} ?>
				</ul>
			</div>	
		</div>
		<div class="test_right">
			<img src="../../images/icon/pin.png" alt="img">
			<div class="clearfix"></div>
			<h2><?php echo $one_title; ?></h2>
			<div class="display_content">			
			<?php foreach($test as $v){ ?>
			<div class="display_test">
				<p><?php echo $num++,'.&nbsp;',htmlspecialchars($v['question'],ENT_QUOTES);?></p>
				<label><nobr><input type="radio" name="choice_<?php echo $num-1; ?>">A.&nbsp;<?php echo htmlspecialchars($v['A'],ENT_QUOTES); ?></nobr></label>
				<label><nobr><input type="radio" name="choice_<?php echo $num-1; ?>">B.&nbsp;<?php echo htmlspecialchars($v['B'],ENT_QUOTES); ?></nobr></label>
				<label><nobr><input type="radio" name="choice_<?php echo $num-1; ?>">C.&nbsp;<?php echo htmlspecialchars($v['C'],ENT_QUOTES); ?></nobr></label>
				<label><nobr><input type="radio" name="choice_<?php echo $num-1; ?>">D.&nbsp;<?php echo htmlspecialchars($v['D'],ENT_QUOTES); ?></nobr></label>
				<p class="test_answer">答案:<span><?php echo $v['answer']; ?></span></p>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
	<?php include('./foot.html');?>
</body>
</html>