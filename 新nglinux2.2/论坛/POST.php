<?php  
$conn=mysqli_connect('localhost','root','flzx_3QC','nglinux');
mysqli_query($conn,'set names utf8');
$sql="insert into forum(content) values ('$_POST[textarea]')";
$res=mysqli_query($conn,$sql);
if(!$res){
	echo '留言失败，请尝试再次留言';
	exit();
}else{
	header('location:../论坛.php');
}
mysqli_close($conn);
?>