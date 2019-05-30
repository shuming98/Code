<?php 
//查询该管理员名字
$sql = "select user_nick from user_data where user_account='$_SESSION[account]'";
$nick = mGetOne($sql);
 ?>

<div class="header">
	<img src="../../images/icon/mlogo.png" alt="mlogo">
	<h1><a href="./home.php" style="color:#fff">Java&nbsp;后台管理系统</a></h1>
	<span>欢迎您,&nbsp;<?php echo $nick; ?>&nbsp;|&nbsp;<a href="../admin/logout.php">退出</a></span>
	<div class="clearfix"></div>
</div>
