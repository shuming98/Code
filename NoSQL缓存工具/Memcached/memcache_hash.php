<?php

$mem = new Memcached();

//服务器配置
$mem->setOptions(array(
	//一致性hash
	Memcached::OPT_DISTRIBUTION=>Memcached::DISTRIBUTION_CONSISTENT,
	Memcached::OPT_LIBKETAMA_COMPATIBLE=>true,
	//如果服务器down掉
	Memcached::OPT_REMOVE_FAILED_SERVERS=>true,
));

//本地开三个memcache进程,假设有三个服务器,连接服务器
$mem->addServers(array(
 array('localhost',11211),
 array('localhost',11212),
 array('localhost',11213)
));

//添加数据
$mem->add('name','wangwu');
$mem->add('age',18);
$mem->add('title','today is sunshine');
$mem->add('xm','wsm');

//获取数据
var_dump($mem->get('name'),$mem->get('age'),$mem->get('title'),$mem->get('xm'));
