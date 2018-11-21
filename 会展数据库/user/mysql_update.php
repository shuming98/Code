<?php
    error_reporting(0);
	$conn = mysqli_connect('127.0.0.1','root','123456','uee');
    mysqli_query($conn,'set names utf8');  
	$id=$_GET['id'];
	if(empty($_POST)){		
	$sql="select * from user where id ='$id'"; 
	$res=mysqli_query($conn,$sql);
	$arr=mysqli_fetch_assoc($res); 
	require('./user_modify.php');
}else{
	$sql2="update user set name='".$_POST['name']."',gender='".$_POST['gender']."',age='".$_POST['age']."',income='".$_POST['income']."',tend='".$_POST['tend']."',mobile_number='".$_POST['mobile_number']."',email='".$_POST['email']."',time=current_timestamp where id='$id'";
	$res2 = mysqli_query($conn,$sql2);
	var_dump($sql2);
	if(res2){
		echo "<script>alert('修改成功');location.replace('user_update.php');</script>";
	}else{
		echo "<script>alert('修改失败');location.replace('user_update.php');</script>";
	}
}	
	mysqli_close($conn);
 ?>
 