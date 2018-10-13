<?php 
class Mysql{
	private $host;
	private $user;
	private $passwd;
	private $dbName;
	private $charset;
	private $conn=null;

	public function __construct()
	{
		$this->host='localhost';
		$this->user='root';
		$this->passwd='';
		$this->dbName='nglinux';
		$this->charset='utf8';

		//连接
		$this->connect($this->host,$this->user,$this->passwd,$this->dbName);

		//切换库
		$this->switchDb($this->dbName);

		//设置字符集
		$this->setChar($this->charset);

	}

	//负责连接
	private function connect($host,$user,$passwd,$dbName)
	{
		$conn=mysqli_connect($host,$user,$passwd,$dbName);
		$this->conn=$conn;
	}

	//负责切换数据库
	public function switchDb($dbName)
	{
		$sql='use '.$dbName;
		$this->query($sql);

	}

	//负责设置字符集
	public function setChar($char)
	{
		$sql='set names '.$char;
		$this->query($sql);
	}

	//负责发送sql查询
	public function query($sql)
	{
		$res=mysqli_query($this->conn,$sql);
		return $res;
	}

	//负责获取多行多列的select结果
	public function getAll($sql)
	{
		$list=array();
		$res=$this->query($sql);
		if(!$res)
		{
			echo '读取多行多列失败';
		}
		while($row=mysqli_fetch_assoc($res))
		{
			$list[]=$row;
		}
		return $list;
	}

	//获取一行的select结果
	public function getRow($sql)
	{
		$res=$this->query($sql);
		if(!$res)
		{
			echo '读取一行失败';
		}
		return mysqli_fetch_assoc($res);
	}

	//获取一个单个的值
	public function getOne($sql)
	{
		$res=$this->query($sql);
		if(!$res)
		{
			echo '读取单个值失败';
		}
		$row=mysqli_fetch_row($res);
		return $row[0];
	}

	//插入数据(可单个可批量)
	public function insert($table,$values)
	{
		$sql='insert into '.$table.' values '.$values;
		return $this->query($sql);
	}

	//同一个表批量插入
	public function insertAll($queue,$value)
	{
		$sql='insert into forum('.$queue.') values ('.$value.')';
		echo $sql,'<br/>';
		return $this->query($sql);
	}


	//修改数据(可单个可批量)
	public function update($table,$values,$where)
	{
		$sql='update '.$table.' set '.$values.' where '.$where;
		return $this->query($sql);
	}

	//删除数据(可单个可批量)
	public function delete($table,$where)
	{
		$sql='delete from '.$table.' where '.$where;
		return $this->query($sql); 
	}

	//关闭sql
	public function close()
	{
		mysqli_close($this->conn);
	}
	
}


//query($sql)
//getAll($sql)
//getRow($sql)
//getOne($sql)
//insertAll($queue,$value)
//insert($table,$values)  
  //例如,$mysql->insert('contact(id,name,contact)',"('id','name','contact')")
//update($table,$values,$where)
  //例如,$mysql->update('forum',"content='you'",'id in(4,8,12)');
//delete($table,$where)
  //例如,$mysql->delete('forum','id between 21 and 39');


$mysql=new Mysql();
//给一个数组，数组键是列，数组值是列的值，自动生成insert语句
$arr=array('id'=>'999','content'=>'null');
foreach($arr as $key=>$value) {
	$res=$mysql->insertAll($key,$value);
}
$mysql->close();
 ?>
