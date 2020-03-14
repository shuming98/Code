<?php 
header('content-type:text/html;charset=utf-8');

//连接memcached服务器
$mem = new Memcached();
$mem->addServer('localhost',11211);

//获取news值，如果没有,就从数据库查询
$res = $mem->get('news');
if(empty($res)){
	$pdo = new PDO('mysql:host=localhost;dbname=p2p','root','123456');
	$pdo->query('set names utf8');
	$sql = 'select pid,title,money from projects';
	$data = $pdo->query($sql)->fetchAll();
	$mem->add('news',$data,10);
	echo 'from mysql';
}else{
	echo 'from memcached';
}

