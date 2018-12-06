<?php
    error_reporting(0);
	$conn = mysqli_connect('127.0.0.1','root','123456','uee');
    mysqli_query($conn,'set names utf8');  
	$id=$_GET['id'];
	if(empty($_POST)){		
	$sql="select * from exhibitor where id ='$id'"; 
	$res=mysqli_query($conn,$sql);
	$arr=mysqli_fetch_assoc($res); 
	require('./exhibitor_modify.php');
}else{
	$sql2="update exhibitor set username='".$_POST['username']."',enterprise='".$_POST['enterprise']."',address='".$_POST['address']."',tel='".$_POST['tel']."',email='".$_POST['email']."',application='".$_POST['application']."',type='".$_POST['type']."',number='".$_POST['number']."',time=current_timestamp where id='$id'";
	$res2 = mysqli_query($conn,$sql2);
	if(res2){
		echo "<script>alert('修改成功');location.replace('exhibitor_update.php');</script>";
	}else{
		echo "<script>alert('修改失败');location.replace('exhibitor_update.php');</script>";
	}
}	
	mysqli_close($conn);
 ?>
 