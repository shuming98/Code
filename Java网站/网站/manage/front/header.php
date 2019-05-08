<?php 
if(!isset($_SESSION['permission'])){
	echo "<script>alert('此非你该来之地');location.href='./index.html';</script>";
}
 ?>
<div class="header">
	<img src="../../images/icon/logo.png" alt="logo">
	<h1>后台管理系统</h1>
	<div class="clearfix"></div>
</div>