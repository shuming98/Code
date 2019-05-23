<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/manage.css">
	<title>后台管理</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="saying">
				<h2>数据无价</h2>
				<p>实行“删除”操作前</p>
				<p>三思而后行</p>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
</html>