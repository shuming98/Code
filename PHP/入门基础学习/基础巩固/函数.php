<?php 
/*一、函数概念：一段封装好的代码，可以随时调用
例如：
function sum($a,$b){
	$c=$a+$b;
	echo $c;
	return;
}
sum(4,3);
二、函数定义格式：
    function 函数名（[参数1，参数2，.....]）{    //函数名定义与变量一样，但不区分大小写
    执行语句；                                           //[]代表内容可写可不写
}

三、函数执行与返回流程：
   顺序执行，return 意思是返回，return 后语句不会执行；
   return 的变量不会显示，需要echo 你设定的变量；

四、函数传参方式
例如：
function add($a){ 
	$a+=2;
	echo $a;
}
$b=6;                         传参就是传值赋值，把 $b 的值赋给 $a ,
add($b);                      你调用函数，不想输入数值，想直接引用已有变量，就用传参；

五、函数变量作用域               //函数内部声明的变量，叫局部变量，php页面声明的变量叫全局变量，两者互不干扰
例如：
 function t($a){              调用全局变量，用 global 变量;
 	global $a;
 	$a+=5;
 	echo $a;
 }
$a=25;
t(35);                         很明显，调用全局变量后，赋值不起作用;


function t1(){
	print_r($_GET);             超全局变量$_GET $_POST......;
}
t1();

六、动态调用函数                   改变函数名，给函数名赋予一个新变量名字
例如:
function wel(){
	for($i=0;$i<50;$i++){
		echo $i,'<br />';
	}
}
$post='wel';                      
$post();

七、判断函数是否存在
function_exists('函数名');
 
八、时间戳函数      时间戳就是1970.01.01 00:00:00 ，到现在的时间

echo time();   获得当前时间戳
echo '<br />';
print_r(microtime(true));  获得当前时间戳，并有毫秒
echo '<br />';
echo date('Y-m-d 星期N H:i:s');  获得当前日期（年月日，星期，时分秒）
echo '<br />';
echo gmdate('Y-m-d 星期N H:i:s'); 获得当前世界时（0区时）
echo '<br />';
echo mktime(7,2,57,7,2,1970);    获得某天时间戳（时分秒，月日年）
echo date('Y-m-d 星期N H:i:s',$time) 获取某时间戳当前日期（日期格式化，时间戳）
echo '<br />';
$bool=checkdate(5,31,2018);    检查日期是否正确（月日年）
var_dump($bool);

作业：
一、测试程序运行时间：
$start=microtime(true);
for($i=0;$i<10000;$i++){
	echo $i;
}
$end=microtime(true);
echo '<br />';
echo $start-$end;

二、判断函数是否存在：
function a(){
	echo 'wq';
}
var_dump(function_exists('b'));	
*/
//三、
//调用全局变量global会影响函数内部，但函数内部变量不影响全局变量(即局部变量与全局变量独立)
$GLOBALS['var1'] = 5;
$var2=1;
function get_value(){
	global $var2;
	$var1 =0;
	return $var2++;
}
var_dump(get_value());
echo $var1."\n";
echo $var2;

/*//现在距离2018.9.9还有多少天
$now=time();
$past=mktime(0,0,0,9,9,2018);
echo $diff=($past-$now)/(24*3600),'天';*/
?>