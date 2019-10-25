<?php

//连接redis服务器
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

//设置字符串(存)
//$redis->set('title','IT领导rm后入狱五年');

//取
$get = $redis->get('name');
echo $get;

//存链表
//$redis->lPush('stus','lisi','zhangsan','wangwu');

//取链表
$link = $redis->lRange('stus',0,-1);
print_r($link);

//存哈希
//$redis->hMset('hash',array('name'=>'hash','score'=>'22','address'=>'network'));

//取哈希
$hash = $redis->hGetall('hash');
print_r($hash);

//存集合
//$redis->sAdd('set',1,2,3);

//取集合
$set = $redis->sPop('set');
print_r($set);


?>
