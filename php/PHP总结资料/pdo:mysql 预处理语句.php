<?php
//第一个参数说明数据库类型、主机、数据库
//第二个参数是账号
//第三个参数是密码
$pdo = new PDO('mysql:host=localhost;dbname=nglinux','root','123456');


$pdo->query('set names utf8');
//查询
//$res = $pdo->query('show tables');
//打印所有结果
//var_dump($res->fetchAll());

//pdo预处理语句
$st = $pdo->prepare('select * from user where name=? and gender=?');
$st->execute(['小王','女']);

print_r($st->fetchAll());

//mysqli预处理语句
$st = $conn->prepare("nsert into user(id,username,passwd) value (?,?,?)");
//绑定参数，i(int)d(double)s(string)b(blob二进制大对象)
$st->bind_param("iss", $id, $username, $passwd);
$id = 1234;
$username = 'kenny';
$passwd = md5('12345');
$st->execute();

 ?>