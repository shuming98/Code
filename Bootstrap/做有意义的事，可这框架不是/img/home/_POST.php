<?php  
$conn=mysqli_connect('127.0.0.1','root','123456','nglinux');
mysqli_query($conn,'set names utf8');
$sql="insert into contact(name,contact,message) values ('$_POST[name]','$_POST[email]','$_POST[message]')";
$res=mysqli_query($conn,$sql);
if(!res){
	echo '留言失败，请尝试再次留言';
	exit();
}
else{
	header('location:../../index.html');
}
mysqli_close($conn);

?>
