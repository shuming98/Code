<?php 
/**
 * 封装php操作mysql语句
 */

/**
 * 连接数据库
 * @return resource 连接成功,返回连接数据库的资源
 */

function mConn(){
	static $conn = null;
	if($conn === null){
		$config = require(ROOT . '/lib/config.php');
		$conn = mysqli_connect($config['host'],$config['user'],$config['passwd'],$config['db']);
		mysqli_query($conn,'set names '.$config['charset']);
	}

	return $conn;
}

/**
 * 查询函数
 * @return resource/bool
 */

function mQuery($sql){
	$res = mysqli_query(mConn(),$sql);
	if(!$res){
		mLog($sql . "\n" . mysqli_error(mConn()));
	}
	return $res;
}

/**
 * log日志记录mysql
 * @param string $str 记录语句/错误报告信息
 */

function mLog($str){
	$filename = ROOT . '/log/' . date('Ymd') . '.txt';
	$log = "---------------------------------------\n" . date('Y/m/d H:i:s') . "\n" . $str . "\n" . "---------------------------------------\n\n";
	return file_put_contents($filename, $log,FILE_APPEND);
}

/**
 * select 查询多行数据
 * @param string $sql select待查询sql语句
 * @return mixed 查询成功返回二维数组，失败返回false
 */

function mGetAll($sql){
	$res = mQuery($sql);
	if(!$res){
		return false;
	}

	$data = array();
	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}

	return $data;
}

/**
 * select 取出一行数据
 * @param string $sql 待查询sql语句
 * @return 查询成功返回一维数组，失败返回false
 */

function mGetRow($sql){
	$res = mQuery($sql);
	if(!$res){
		return false;
	}

	return mysqli_fetch_assoc($res);
}

/**
 * select 查询返回一个结果
 * @param string $sql 待查询sql语句
 * @return 成功返回结果，失败返回false
 */

function mGetOne($sql){
	$res = mQuery($sql);
	if(!$res){
		return false;
	}

	return mysqli_fetch_row($res)[0];
}

/**
 * 拼接insert 和 update 语句,并调用mQuery()执行
 * @param string $table 表明
 * @param array $data (数组形式的)数据
 * @param string $act 操作select/upadte 默认select
 * @param string $where where条件,默认$where = 0
 * @return bool insert/update 成功或失败
 */

function mExec($table,$data,$act='insert',$where=0){
	if($act == 'insert'){
		$sql = "insert into $table (";
		$sql .= implode(',' , array_keys($data)) . ") values ('";
		$sql .= implode("','" , array_values($data)) . "')";
		return mQuery($sql);
	}else if($act == 'update'){
		$sql = "update $table set ";
		foreach($data as $k=>$v){
			$sql .= $k . "='" . $v . "',";
		}

		$sql = rtrim($sql , ',') . " where " . $where;
		return mQuery($sql);
	}
}

/**
 * 获得上一步insert 操作产生的主键id
 */

function getLastId(){
	return mysqli_insert_id(mConn());
}

/**
 * 使用反斜线，转义字符串(防止sql注入)
 * @param array 待转义的数组
 * @return array 被转义后的数组
 */

function _addslashes($array){
	foreach($array as $k=>$v){
		if(is_string($v)){
			$array[$k] = addslashes($v);
		}else if(is_array($v)){
			$array[$k] = _addslashes($v);
		}
	}
	return $array;
}
 ?>