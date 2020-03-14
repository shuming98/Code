<?php 
class MySQL{}
class Oracle{}
class SQLite{}

$_CFG['dbtype'] = 'MySQL';

class DB{
	//函数参数不能加[],把$_CFG['dbtype']换成$dbtype即可解决报错
	public static function getDB($_CFG['dbtype']){
		if($_CFG['dbtype'] == 'MySQL'){
			return new MySQL();
		}else if($_CFG['dbtype'] == 'Oracle'){
			return new Oracle();
		}else if($_CFG['dbtype'] == 'SQLite'){
			return new SQLite();
		}
	}
}

DB::getDB('MySQL');
 ?>
