<?php
abstract class aDB {

	/**
	* 连接数据库,从配置文件读取配置信息
	*/
	abstract public function __construct();


	/**
	* 发送query查询
	* @param string $sql sql语句
	* @return mixed
	*/
	abstract public function query($sql);


	/**
	* 查询多行数据
	* @param string $sql sql语句
	* @return array
	*/
	abstract public function getAll($sql);


	/**
	* 单行数据
	* @param string $sql sql语句
	* @return array
	*/
	abstract public function getRow($sql);


	/**
	* 查询单个数据 如 count(*)
	* @param string $sql sql语句
	* @return mixed
	*/
	abstract public function getOne($sql);


	/**
	* 自动创建sql并执行
	* @param array $data 关联数组 键/值与表的列/值对应
	* @param string $table 表名字
	* @param string $act 动作/update/insert
	* @param string $where 条件,用于update
	* @return int 新插入的行的主键值或影响行数
	*/
	abstract public function Exec($data , $table , $act='insert' , $where='0');

	/**
	* 返回上一条insert语句产生的主键值
	*/
	abstract public function lastId();

	/**
	* 返回上一条语句影响的行数
	*/
	abstract public function affectRows();
}

class Mysql extends aDB {
	public $mysqli;

	/**
	* 连接数据库,从配置文件读取配置信息
	*/
	public function __construct(){
		$cfg = require('./config.php');
		$this->mysqli = new mysqli($cfg['host'],$cfg['user'],$cfg['passwd'],$cfg['db']);
		$this->mysqli->set_charset($cfg['charset']);
	}


	/**
	* 发送query查询
	* @param string $sql sql语句
	* @return mixed
	*/
	public function query($sql){
		return $this->mysqli->query($sql);
	}


	/**
	* 查询多行数据
	* @param string $sql sql语句
	* @return array
	*/
	public function getAll($sql){
		$res = $this->query($sql);
		$data = array();
		while($row = $res->fetch_assoc()){
			$data[] = $row;
		}

		return $data;
	}


	/**
	* 单行数据
	* @param string $sql sql语句
	* @return array
	*/
	public function getRow($sql){
		return $this->query($sql)->fetch_assoc();
	}


	/**
	* 查询单个数据 如 count(*)
	* @param string $sql sql语句
	* @return mixed
	*/
	public function getOne($sql){
		return $this->query($sql)->fetch_row()[0];
	}


	/**
	* 自动创建sql并执行
	* @param array $data 关联数组 键/值与表的列/值对应
	* @param string $table 表名字
	* @param string $act 动作/update/insert
	* @param string $where 条件,用于update
	* @return int 新插入的行的主键值或影响行数
	*/
	public function Exec($data , $table , $act='insert' , $where='0'){
		//insert into ttt(kk,kk,kk) values ('v','v','v');
		if($act == 'insert'){
			$sql = "insert into $table (";
			$sql .= implode(',',array_keys($data)) . ')';
			$sql .= " values ('";
			$sql .= implode("','",array_values($data)) . "')";
			$this->query($sql);
			return $this->lastId();
		}else if($act == 'update'){
			//update ttt set xxx='v',xxx='v',xxx='v' where xxx=xxx;
			$sql = "update $table set ";
			foreach($data as $k=>$v){
				$sql .= $k . "='" . $v . "',";
			}
			$sql = rtrim($sql,',') . " where " . $where;
			$this->query($sql);
			return $this->affectRows();
		}
	}

	/**
	* 返回上一条insert语句产生的主键值
	*/
	public function lastId(){
		return $this->mysqli->insert_id;
	}

	/**
	* 返回上一条语句影响的行数
	*/
	public function affectRows(){
		return $this->mysqli->affected_rows;
	}
}

//new一个对象
$mysql = new Mysql();
//获取所有结果
var_dump($mysql->getAll('select * from contact'));echo '<br/>';
//获取一行结果
var_dump($mysql->getRow('select * from contact'));echo '<br/>';
//获取一个结果
echo $mysql->getOne('select * from contact');echo '<br/>';
//插入数据
$in_data=array('name'=>'insert','message'=>'insert success');
echo $mysql->Exec($in_data,'contact','insert');echo '<br/>';
//更新数据
$up_data=array('name'=>'update','message'=>'update success');
echo $mysql->Exec($up_data,'contact','update','id>4');echo '<br/>';
//删除数据
var_dump($mysql->query('delete from contact where id>8'));
?>