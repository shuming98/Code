<?php 
//属性、方法权限修辞词：
//private 	仅本类可用
//protected 允许本类、子类使用，类外部不可调用
//public 	谁能都用

//final类不能被继承，final方法不能被子类重写

//static占单独内存块，并不随函数消失而消失
//static静态属性与方法，可节省内存使用，很重要！

//abstract抽象类与抽象方法(模板)不能直接使用，只能继承使用，里面可有实例方法

//interface接口本身是抽象的，不用加abstract,接口里的方法只能是public，类可以同时实现多个接口

//抽象类是类的模板[一类事物的规范]，接口是方法的模板[组成事物零件的规范]

//$this 代表 本对象
//self 代表 本类(类名) //类的通用性
//parent 代表 父类   //子类重写方法后，还想用父类的方法，加parent::方法名

//魔术方法 自动调用
//__construct()	构造方法，new实例时，自动调用
//__destruct()	析构方法，对象销毁时自动调用
//__get()			读取不可见（未定义或无权访问）属性时，自动调用
//__set()			对一个不可见属性赋值时，自动调用
//__isset()		isset/empty判断不可见属性时，自动调用
//__unset()		unset不可见属性时，自动调用

//自动加载[极度简便框架使用]
//[如果你在本类中运行一个没有的类，此时会触发自动加载函数，并把你运行的类名做参数传递给”自动加载“函数]
function myload($class){
	require('./'.$class.'.class.php');//文件加载路径 如，./mysql.class.php
}

spl_autoload_register('myload');  //调用自动加载函数   

//如，new mysql();

//异常处理[抛出异常],代码写复杂时，用抛出异常代替return false
throw new Exception('错误提示信息',1[错误代码]);

//接受异常[你想知道那里出现异常]
try{
	//执行Code...
}catch(Exception $e){
	echo '文件：',$e->getFile(),'<br>';
	echo '行：',$e->getLine(),'<br>';
	echo '错误信息：',$e->getMessage(),'<br>';	
}

//分层命名空间[重名类，不影响使用]
namespace yourname;
//使用
//① use yourname\className as c; //起别名
//   new c();

//② new \yourname\className();

//PHP是弱类型语言，不需要声明数据类型，没有多态。多态就是一个实体的多种形式。允许父类有多种类型。

class Bird{ //创建类 大驼峰命名
	
	//属性 可赋值可不赋值，5.6后允许数组、字符串、简单运算表达式。不可以赋值函数
	public $color = 'red';
	public $weight = 0;

	//静态属性 调用：不用new,类名::$变量名
	static public $age = 1;
	//echo Bird::$age;
	
	//类常量 类内部使用 方法调用:类名::类常量名
	const PI=3.1415;
	//public function test(){echo Bird::PI;}


	//构造方法 初始化 传参 new后自动调用
	public function __construct($color,$weight){
		$this->color = $color;
		$this->weight = $weight;
		echo '呱呱而叫';
	}

	//析构方法 对象销毁自动执行
	public function __destruct(){
		echo 'awsl';
	}

	//静态方法 调用：不用new，直接类名::方法名 
	static public function add($a,$b){
		return $a+$b;
	}
	//echo Bird::add(4,5);	

	//方法
	function fly(){
		echo "go";
	}

	function say(){
		echo 'my color is' . $this->$color; //this指代调用它的对象
	}	
}

//实例化对象
//$a = new Bird();
//$b = new Bird('red',30); //构造方法
//调用属性
//echo $a->color;
//echo $a->color = 'yellow';
//调用方法
//$a->fly();

//继承 php是单继承的
//final类不能被继承，final方法不能被子类重写
class Jay extends Bird{
	public function jiao(){
		echo 'jiao';
	}
}

//echo '<br/>';
//$son = new Jay('red',20);
//$son->say();


class Human{
	public $age = 12;
	public $height = 30;

	public function aa(){
		echo 'ggg';
	} 
}

// //$xiaowang = new Human();
// //$xiaowang->height = 50;

// //封装Mysql
class Mysql{
	public $link;

	public function conn(){
		$cfg = array(
			'host' => '127.0.0.1',
			'user' => 'root',
			'pwd' => '123456',
			'db' => 'nglinux',
			'charset' => 'utf8'
		);
		$this->link = mysqli_connect($cfg['host'],$cfg['user'],$cfg['pwd'],$cfg['db']);
		mysqli_query($this->link,'set names '.$cfg['charset']);
	}

	public function query($sql){
		return mysqli_query($this->link,$sql);
	}

	public function getAll($sql){
		$res = $this->query($sql);
		$data = array();
		while($row = mysqli_fetch_assoc($res)){
			$data[] = $row;
		}
		return $data;
	}
}

//$mysql = new Mysql();
//$mysql->getAll('select * from forum');

final class B{
	final function b(){
		echo 'final类、方法不能继承、重写';
	}	
}


//单例模式————只能造出一个对象的设定[代码只运行一次]
final class Single{

	public $rand;
	static public $ob = null;

	protected function __construct(){
		$this->rand = mt_rand(100,500);
	}

	static public function getIns(){
		if(self::$ob === null){
			self::$ob = new self();
		}

		return self::$ob;
	}
}

//$a = Single::getIns();
//print_r($a);

//parent
class Par{
	public function __construct(){
		echo '父类';
	}
}

class Son extends Par{
	public function __construct(){
		parent::__construct(); //用父类方法名
		echo '子类'; //子类重写
	}
}

//魔术方法
class Magic{
	public $b=3;
	//访问不可见属性
	public function __get($a){
		echo $a;
	}

	//设置不可见属性值时调用
	public function __set($a,$b){
		echo $a,'=',$b;
	}

	//判断不可见属性时调用
	public function __isset($a){
		echo '$a';
	}

	//销毁不可见属性时调用
	public function __unset($a){
		echo $a;
	}
}

$a = new Magic();
//__get
$a->get;
echo '<br/>';
//__set
$a->set=1;
echo '<br/>';
//__isset
isset($a->a);
echo '<br/>';
//__unset
unset($a->a);
echo '<br/>';

//抽象类与抽象方法，不能直接用，只能继承下来使用
abstract class DB{
	abstract public function getAll($sql){
		/**
		 * @param $sql
		 * @return array
		 */
	}

	abstract public function getRow($sql){
		/**
		 * @param $sql
		 * @return array
		 */
	}

	/*可以有实例方法*/
	public function getOne($sql);
			echo 'linux';
}

//继续抽象类(模板)
class Mysql extends DB{

}

//编写接口
interface flyer{
	public function fly($w,$h);
}

interface runner{
	public function run($l,$m);
}

//实现接口(写了接口必须实现)
class mysql2 implements flyer,runer{
	public function fly($w,$h){
		echo $w . '飞了' . $h;
	}
}
?>