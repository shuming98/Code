<?php 
/**
 * 单例模式————只能造出一个对象的设定[代码只运行一次]
 */
 
final class Single{ //①final类

	public $rand;
	static public $ob = null; //②static 属性控制

	protected function __construct(){ //③protected 构造方法
		$this->rand = mt_rand(100,500);
	}

	static public function getIns(){ //②static方法控制
		if(self::$ob === null){
			self::$ob = new self();
		}

		return self::$ob;
	}
}

$a = Single::getIns(); //④static调用方法
print_r($a);
 ?>
