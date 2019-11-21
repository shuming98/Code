<?php
 class App{
 	//接管系统错误的处理权限
 	public function __construct(){
 		$this->initSystemHandlers();
 	}

 	//初始化
 	public function initSystemHandlers(){
 		//设置用户自定义的错误处理函数
 		//set__xxx(函数名)
 		//set__xxx(类名::静态方法)
 		//set__xxx([对象,方法])
 		set_error_handler([$this,'handlerError']);
 		//*设置用户自定义的异常处理函数
 		set_exception_handler([$this,'handlerException']);
 	}

 	//自定义的错误处理函数
 	public function handlerError($errno,$errstr,$errfile,$errline) {
        throw new ErrorException($errstr,$errno,1,$errfile,$errline);
    }
 	
 	//*自定义的异常处理函数
 	public function handlerException($e){
 		//禁止再处理错误或异常，防止递归
 		restore_error_handler();
 		restore_exception_handler();
 		$this->handler($e);
 	}

 	//抛出异常处理模板
 	public function handler($e){
 		//输出易于阅读的异常信息
 		echo '<h2>',$e->getFile();
 		echo ',第',$e->getLine(),'行</h2>';
 		echo '<h3>',$e->getMessage(),'</h3>';
 		echo '<pre>';
 		$trace = $e->getTrace();

 		if($e instanceof ErrorException){
 			//移除数组开头单元
 			array_shift($trace);
 		}

 		print_r($trace);
 	}

 	/**
 	 * 调用控制器和方法
 	 * @param $c className 类
 	 * @param $a Action 方法
 	 * @return [type] [description]
 	 */
 	public function run(){
 		//分析URL参数
 		list($c,$a) = $this->resolve();
 		//调用控制器和方法
 		$c = $c . 'Controller';
 		$controller = new $c();
 		$controller->$a();
 	}

 	//URL分析
 	//如xxx/Controller/Action/id/3/pages/5
 	public function resolve(){
 		$path = $_SERVER['PATH_INFO'] ?? [];
 		if(is_string($path)){
 			//分割字符串,去除收尾/字符 /sdf
 			$path = explode('/',trim($path,'/'));
 		}

 		$path = $path + ['Index','index'];
 		//从数组中取出字符段
 		$ca = array_slice($path,0,2); //取出0-1
 		$params = array_slice($path,2);//取出2...

 		for($i=0,$cnt=count($params);$i+1<$cnt;$i++){
 			$_GET[$param[$i]] = $params[$i+1];
 		}

 		return $ca;
 	}
 }

 ?>
