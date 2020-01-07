<?php 
error_reporting(0);
include ('../conn.php');
$data="insert into exhibitor(username,enterprise,address,tel,email,application,type,number) values ('".$_POST['username']."','".$_POST['enterprise']."','".$_POST['address']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['application']."','".$_POST['type']."','".$_POST['number']."')"; 
$data2="insert into message(username,enterprise,email,message) values ('".$_POST['username']."','".$_POST['enterprise']."','".$_POST['email']."','".$_POST['message']."')"; 
if((mysqli_query($conn,$data)) && (mysqli_query($conn,$data2))){
	echo "<script>alert('添加成功');location.replace('exhibitor_add.html');</script>";
}else{
	echo "<script>alert('添加失败');location.replace('exhibitor_add.html');</script>";
}
mysqli_close($conn);
?>	