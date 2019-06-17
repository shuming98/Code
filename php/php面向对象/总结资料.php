<?php
/**
 * @example 详细用法请看test.php
 * @author PHPer
 */

一、类与对象
abstract class aClassName{
	public $name;
	public function method();
}

interface methods{
	public function method_one($a,$b);
}

//创建类 大驼峰命名
final class ClassName extends aClassName implements methods{
	//属性 可赋值可不赋值，5.6版本后允许数组、字符串、简单运算表达式。不可以赋值函数
	public $name;
	static public $num = 1;

	//类常量 调用(与static相似) 类名::类常量名
	const PI=3.14159;

	static public function method(){
		//Code...
		$this->name; //this调用
	}

	public function method_one($a,$b){
		return $a + $b;
	}

	final function end(){
		echo 'final类、方法不能被继承、重写'
	}
}

1)new一个对象
$obj = new ClassName();

2)调用属性
$obj->name;
ClassName::$num; //static

3)调用方法
$obj->method();
ClassName::method(); //static

二、修辞词
1）属性和方法
private 	私有的(仅本类可用)
protected 	保护的(本类及子类可用)
public 		公有的(皆可访问)

2）类与方法
final 		最终的(final类不能被继承，final方法不能被子类重写)
static 		静态的(调用 类名::$变量名/方法)

//abstract抽象类与抽象方法(模板)不能直接使用，只能继承使用，里面可有实例方法
abstract	抽象的(类模板，子类继承使用)	class Son extends Parent{}

3）方法
//interface接口本身是抽象的，不用加abstract,接口里的方法只能是public，类可以同时实现多个接口
interface 	接口(方法模板，使用了必须实现)	class Class implements method{}

//抽象类是类的模板[一类事物的规范]，接口是方法的模板[组成事物零件的规范]

三、代表who
//this绑定(指向调用它的对象，也就是“自己”,方法体内调用类中属性必须用$this)
$this 	代表	  本对象
self 	代表   本类(类名) //类的通用性
parent  代表   父类		//子类重写方法后，还想用父类的方法，加parent::方法名


四、魔术方法 自动调用 限制外部对内部的控制;方便SQL增删改查等框架工作
1)__construct()	构造方法，new实例时，自动调用
2)__destruct()	析构方法，对象销毁时自动调用
3)__get()		读取不可见（未定义或无权访问）属性时，自动调用
4)__set()		对一个不可见属性赋值时，自动调用
5)__isset()		isset/empty判断不可见属性时，自动调用
6)__unset()		unset不可见属性时，自动调用

五、自动加载 引入不存在的类时，会自动加载，极度简便框架的使用
//[如果你在本类中运行一个没有的类，此时会触发自动加载函数，并把你运行的类名做参数传递给”自动加载“函数]

//编写自动加载执行的函数
function myload($class){
	require('引入类的路径');
}
//使用自动加载函数
spl_autoload_register('myload');

六、异常处理
1)抛出异常
throw new Exception('错误提示信息',1[错误代码]);
2）接受异常
try{
	//Code...
}catch(Exception $e){
	echo $e->getFile(); //文件
	echo $e->getLine(); //行
	echo $e->getMessage(); //信息
}

七、命名空间 避免命名重复 分层处理命名(类似磁盘)
namespace name;
1)new \name\Class();
2)use name\Class as alias; new alias();

八、不断学习
1.static占单独内存块，并不随函数消失而消失。
2.static静态属性与方法，可节省内存使用，很重要！
?>