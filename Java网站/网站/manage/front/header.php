<?php 
//查询该管理员名字
$sql = "select user_nick from user_data where user_account='$_SESSION[account]'";
$nick = mGetOne($sql);

 ?>
<div class="header">
	<img src="../../images/icon/logo.png" alt="logo">
	<h1>后台管理系统</h1>
	<span>欢迎您,<?php echo $nick; ?>--<a href="../admin/logout.php">退出</a></span>
	<div class="clearfix"></div>
</div>
