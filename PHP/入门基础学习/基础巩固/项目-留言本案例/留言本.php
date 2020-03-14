<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Document</title>
</head>
<body>
	<form action="./添加留言.php" method="POST">
		<p>用户名:&nbsp&nbsp<input type="text" name="user"></p>
		<p>留言栏:&nbsp&nbsp<textarea name="content" cols="30"  rows="10" ></textarea></p>
		<input style="font-size: 2em;width: 50px;" type="submit" name="提交">
	</form>
	<?php 
	#读取留言
	$conn=mysqli_connect('localhost','root','flzx3qc','php'); //连接数据库
	mysqli_query($conn,'set names utf8');  //设定字符集
	$data=mysqli_query($conn,'select * from liuyanben');//查询表
	while($row=mysqli_fetch_assoc($data)){  //读取表数据
		echo '<p style="margin-left:20px;border-bottom:1px dashed black;">',$row['user'],':',$row['content'],
		'<a style="float:right;margin-right:30px;" href="./编辑留言.php?id=',$row['id'],'">编辑</a>',
		'<a style="float:right;margin-right:30px;" href="./删除留言.php?id=',$row['id'],'">删除</a>',
	'</p>';
	}
	mysqli_close($conn);
	?>

	
	<?php
	/*#通过地址栏输入“?id=”来确定你要读取那条留言(=>你要读取那张帖子内容)
	$id=$_GET['id'];
	$solo='select * from liuyanben where id=' . $id;     //查询表
	$sololy=mysqli_query($conn,$solo);    			     
	$getsolo=mysqli_fetch_assoc($sololy);                //读取表数据
	echo '<h1>',$getsolo['user'],'</h1>';
	echo '<h2>',$getsolo['content'],'</h2>';
	echo '<h4>',date('Y-m-d',$getsolo['pubtime']),'</h4>';
	mysqli_close($conn);*/
	?>
	</body>
</html>
