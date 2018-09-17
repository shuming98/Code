<?php
	$conn = mysqli_connect('localhost','root','flzx3qc','php');//连接数据库
	mysqli_query($conn,'set names utf8');
	$id=$_GET['id'];//传递参数

	$sql="select * from liuyanben where id ='$id'"; 
	$res=mysqli_query($conn,$sql);
	$arr=mysqli_fetch_assoc($res); //输出当前数据至表单

	$sql2="update liuyanben set user='".@$_POST['user']."',content='".@$_POST['content']."' where id='$id'"; //更改数据
	$res2 = mysqli_query($conn,$sql2);

	mysqli_close($conn);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>修改留言</title>
</head>
<body>
	<form action="" method="POST">
		<p>用户名:&nbsp&nbsp<input type="text" name="user" value="<?php echo $arr['user'];?>"></p>
		<p>留言栏:&nbsp&nbsp<textarea name="content" cols="30"  rows="10" ><?php echo $arr['content'];?></textarea></p>
		<input type="submit" name="提交" >
		<a href="./留言本.php">返回</a>
	</form>
</body>
</html>
