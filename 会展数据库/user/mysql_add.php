<?php 
error_reporting(0);
$conn=mysqli_connect('127.0.0.1','root','123456','uee');
mysqli_query($conn,'set names utf8');
$data="insert into user(name,gender,age,income,tend,mobile_number,email) values ('".$_POST['name']."','".$_POST['gender']."','".$_POST['age']."','".$_POST['income']."','".$_POST['tend']."','".$_POST['mobile_number']."','".$_POST['email']."')"; 
if(mysqli_query($conn,$data)){
	echo "<script>alert('添加成功');location.replace('user_add.html');</script>";
}else{
	echo "<script>alert('添加失败');location.replace('user_add.html');</script>";
}
mysqli_close($conn);
?>	