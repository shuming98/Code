<?php 
class Single(){
	//防止外部new操作
	protected static $ins = null;
	
	//防继承后修改
	final protected function __construct(){
		//类代码
		//code..
	}

	//静态方法不受类影响
	public static function getIns(){
		if(self::$ins === null){
			self::$ins = new self();
		}
		return self::$ins;
	}

	//防外界克隆
	protected function __clone(){

	}
}

Single::getIns();
 ?>

