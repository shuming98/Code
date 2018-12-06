<?php 
error_reporting(0);
$conn=mysqli_connect('127.0.0.1','root','123456','uee');
mysqli_query($conn,'set names utf8');
$data="insert into account(username,password) values ('".$_POST['username']."','".$_POST['password']."')"; 
if(mysqli_query($conn,$data)){
	echo "<script>alert('添加成功');location.replace('account_add.html');</script>";
}else{
	echo "<script>alert('添加失败');location.replace('account_add.html');</script>";
}
mysqli_close($conn);
?>	