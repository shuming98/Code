<?php 
error_reporting(0);
include ('../conn.php');
$data="insert into account(username,password) values ('".$_POST['username']."','".$_POST['password']."')"; 
if(mysqli_query($conn,$data)){
	echo "<script>alert('添加成功');location.replace('account_add.html');</script>";
}else{
	echo "<script>alert('添加失败');location.replace('account_add.html');</script>";
}
mysqli_close($conn);
?>	