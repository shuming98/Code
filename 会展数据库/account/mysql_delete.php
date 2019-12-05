<?php 
    error_reporting(0);
	$id = $_GET['id'];
	include ('../conn.php');	
	$sql = "delete from account where id='$id'";
	$res = mysqli_query($conn,$sql);

	if(!$res){
		echo "<script>alert('删除失败');location.replace(document.referrer);</script>";
	}else{
		echo "<script>alert('删除成功');location.replace(document.referrer);</script>";
	}
	mysqli_close($conn);	
 ?>