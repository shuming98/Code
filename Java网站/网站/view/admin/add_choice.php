<?php 
session_start();
require('../../lib/init.php');
$array = $_POST;

//插入test表并获取id
$test['title'] = $_POST['title'];
$test['user_account'] = $_SESSION['user_account'];
mExec('test',$test);
$id = getLastId();

//删除数组头元素
array_shift($array);

//构造sql语句
$sql = "insert into choice_test(test_id,question,A,B,C,D,answer) values";

for($i = 0;$i < count($array[q]);$i++){
	$sql .= "(".$id.",'".$array[q][$i]."','".$array[A][$i]."','".$array[B][$i]."','".$array[C][$i]."','".$array[D][$i]."','".$array[res][$i]."'),";
}

$newsql = substr($sql,0,strlen($sql)-1);

$res = mQuery($newsql);

if($res){
	echo "<script>location.href='../front/t_test.php';</script>";
}else{
	echo "<script>alert('添加失败');history.back();</script>";
}
?>
