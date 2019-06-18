<?php 
//模板前端使用请查看 ./dir/1.html文件
require('./Smarty/Smarty.class.php');

//new
$smarty = new Smarty();

//设置模板路径，优先寻找当前目录,再寻找定义的目录
$smarty->template_dir = './dir';

//设置左边界符
#$smarty->left_delimiter = '{'; 
//设置右边界符
#$smarty->right_delimiter = '}';

//开启缓存
$smarty->caching = true;
//缓存生命周期(秒)
$smarty->cache_lifetime = 30;
//判断是否有缓存
echo $smarty->isCached('./1.html')?'有Cache':'无Cache';

//单模板多缓存
$id = $_GET['id'];
if(!$smarty->isCached('./1.html',$id)){
	$smarty->assign('id',$id);
}

//局部缓存(一个页面某部分需要缓存，某部分不需要缓存) 适应于单个标签不缓存
$smarty->assign('nocache','单个标签不缓存-变化内容',true);
$smarty->assign('nocache2','{nocache}适用于大段不缓存的地方{/nocache}');

//变量赋值(单个)
#$smarty->assign('key',value);
$smarty->assign('var','123');

//数组赋值
$arr = array('one'=>1,'two'=>2);
$smarty->assign('array',$arr);

//类属性赋值
class Obj{
	public $obj = '对象';
}
$smarty->assign('obj',new Obj());

//逻辑-判断
$num = mt_rand(4,6);
$smarty->assign('n',$num);

//逻辑-循环
$know = array(
	array('id'=>1,'title'=>'计算机','content'=>'仿人体结构'),
	array('id'=>2,'title'=>'显示器','content'=>'60fps')
);
$smarty->assign('know',$know);

//变量调节器
$smarty->assign('up','AssbIJo');

//模板调用PHP函数 insert_xxx(){} 
function insert_hanshu(){
	echo '前端调用:insert name=函数名';
}

//引入文件，并输出
$smarty->display('1.html');
?>

<!-- 总结
1.模板中的变量三种来源：assign赋值(存储在_tpl_vars属性中)、系统变量、配置文件读取(存储在_config属性)

2.模板编译的特点：
1）先编译php文件，再执行该PHP。第一次运行较慢(编译模板+include执行)，之后运行速度会快。
2）smarty会根据模板修改时间重新编译模板。
3）强制编译：force_compile = true

3.display 与 fetch 区别：display自带echo;fetch 用的是return,输出需要echo一下。

4.什么时候用缓存：访问量大
1）打开缓存：$smarty->caching = true;
2）缓存生命周期(秒)：$smarty->cache_lifetime = 120;
3）判断是否有缓存：$smarty->isCached('./1.html');

5.PHP可以不用模板：PHP本身是一种标签语言，可以嵌套在html中。
1）模板解析编译，消耗性能；
2）高效缓存工具，如memcached；
3）一些框架(TP,laravel) 和Smarty模板语法触类旁通，降低学习成本；

6.MVC 和 Smarty 的关系：无关系
1）逻辑视图数据的分离(代码分层)：
modal 数据处理层(专门处理数据的)
controller 业务逻辑层(专门处理逻辑的，所有人只能访问C层)
view 试图展示层(模板、数据展示)

2）Smarty 前后台分离。
 -->