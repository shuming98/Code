<?php

//三目运算符
$a = 3;
$b = $a?$a:1;
$b = $a?:1;
echo $b; 

//匿名函数
$sum = function($a,$b){
	return $a + $b;
};

echo $sum(2,5);

//数据写法新形式
$arr = array(1,2,3,4);
$arr = [1,2,3,4];
print_r($arr);

//直接调用数组某个值
echo $arr[1];
echo [1,2,3,4][0];

//调用类方法更加灵活
// $dog = new Dog();
// (new Dog())->bark();

//支持二进制输出
echo 0b0101;

//短标签
$title = '今天天气真好';
?>
<?php echo $title;?>
<?=$title?>

<?php

//trait特性:介于类与接口之间，使具体方法能够多继承引用。
trait Flyer{
	public function fly(){
		echo 'fly';
	}
}

trait Swimer{
	public function swim(){
		echo 'swim';
	}
}

class Super{
	use Flyer,Swimer;
}

(new Super())->fly();

//echo类名
echo Super::class;


//数组赋值给list,foreach支持list
list($a,$b) = [1,2];
$arr3 = [[1,2],[3,4],[5,6]];

foreach($arr3 as list($v,$v2)){
	echo $v,$v2,'<br/>';
}

//try,catch,最后不知道啥错误用finally
try{

}catch(ErrorException $e){

}finally{

}

//foreach 与 getAll()嵌套执行
function getAll(){
	$i = 1;
	while($i<=5){
		yield $i;
		$i+=1;
		//sleep(1);
	}
}

foreach(getAll() as $v){
	echo $v , '<br/>';
}

//const常量能用表达式
const PI = 3.14156 + 1;
echo PI;

//传入参数打包成数组
function sum(){
	print_r(func_get_args());
}

function sum2(...$arg){
	print_r($arg);
}

sum(1,2,3);

//把数组作为参数传入函数拆包输出
$arr = ['kenny',18,'gogo'];

function info($name,$age,$desc){
	echo $name,$age,$desc;
}

info(...$arr);

//立方运算
echo pow(2,5);
echo 2 ** 5;

//判断是否存在
$page = isset($_GET['page'])?$_GET['page']:1;
$page = $_GET['page'] ?? 1;

//弱类型语言，声明变量
function sum3(int $a,int $b){
	return $a + $b;
}

echo sum3(2,3);


 ?>