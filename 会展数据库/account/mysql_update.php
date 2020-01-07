<?php
    error_reporting(0);
	include ('../conn.php');
	$id=$_GET['id'];
	if(empty($_POST)){		
	$sql="select * from account where id ='$id'"; 
	$res=mysqli_query($conn,$sql);
	$arr=mysqli_fetch_assoc($res); 
	require('./account_modify.php');
}else{
	$sql2="update account set password='".$_POST['password']."',time=current_timestamp where id='$id'";
	$res2 = mysqli_query($conn,$sql2);
	if(res2){
		echo "<script>alert('修改成功');location.replace('account_update.php');</script>";
	}else{
		echo "<script>alert('修改失败');location.replace('account_update.php');</script>";
	}
}	
	mysqli_close($conn);
 ?>
 