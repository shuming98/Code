<?php 
if(!isset($_SESSION['permission'])){
	header('Location:../../index.php');
	exit;
}
 ?>
<div class="header">
	<img src="../../images/icon/logo.png" alt="logo">
	<h1>后台管理系统</h1>
	<div class="clearfix"></div>
</div>