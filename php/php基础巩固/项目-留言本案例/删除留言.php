<?php 
	$id = $_GET['id']; //传递参数
	$conn=mysqli_connect('localhost','root','flzx3qc','php');//连接数据库
	mysqli_query($conn,'set names utf8');
	$sql = "delete from liuyanben where id='$id'";   //删除数据
	$res = mysqli_query($conn,$sql);

	if(!$res){
		echo mysqli_error();
		exit();
	}else{
		header('location:./留言本.php');
	}
	mysqli_close($conn);	
 ?>