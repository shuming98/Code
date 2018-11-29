<?php 
    error_reporting(0);
	$id = $_GET['id'];
	$conn=mysqli_connect('127.0.0.1','root','123456','uee');
	mysqli_query($conn,'set names utf8');
	$sql = "delete from message where id='$id'";
	$res = mysqli_query($conn,$sql);

	if(!$res){
		echo "<script>alert('删除失败');location.replace(document.referrer);</script>";
	}else{
		echo "<script>alert('删除成功');location.replace(document.referrer);</script>";
	}
	mysqli_close($conn);	
 ?>