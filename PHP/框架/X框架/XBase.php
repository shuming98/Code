<?php 
class XBase{
	//单例模型
	protected static $app = null;
	//自动加载类映射
	public static $classMap = [];

	public static function app(){
		if(self::$app === null){
			self::$app = new App();
		}
		return self::$app;
	}

	//自动加载
	public static function autoload($class){
		if(isset(self::$classMap[$class])){
			require(self::$classMap[$class]);
		}elseif(substr($class,-10) === 'Controller'){
			require(APP_PATH . '/Controller/' . $class . '.php');
		}
	}
}
 ?>
