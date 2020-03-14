<?php 
#添加留言
$conn=mysqli_connect('localhost','root','flzx3qc','php');  //连接数据库
mysqli_query($conn,'set names utf8');  //给数据库发送(查询指令)执行
$data="insert into liuyanben(user,content,pubtime) values ('".$_POST['user']."','".$_POST['content']."',".time().")"; //添加数据
if(mysqli_query($conn,$data)){ //写入数据库
	header('location:./留言本.php');
}else{
	echo '留言失败,请尝试再次留言';
}
mysqli_close($conn);
?>