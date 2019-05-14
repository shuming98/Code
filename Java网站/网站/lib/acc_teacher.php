<?php 
if($_SESSION['permission_id']!=1 && $_SESSION['permission_id']!=2){
	 	header('Location:../../index.php');
	 	exit;
	 }
 ?>