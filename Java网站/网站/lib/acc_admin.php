<?php 
if(!isset($_SESSION['permission']) && !isset($_SESSION['permission_id'])){
	header('Location:../../index.php');
	exit;
}
 ?>
