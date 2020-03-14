<?php 
/*
一、变量类型：整形、浮点型、字符串、布尔、数组、对象、NULL、资源

二、isset(变量,变量,变量.......)  检测变量是否存在       用法：if
 显示变量类型(单一使用)     用法：echo

    is_int(var) is_double() ....检测特定变量类型是否存在(单一使用)  用法：if
四、输出变量值{
	echo 字符串 
    print_r() 数组(单一输出)               输出（打印）变量值    用法：直接用 
     var_dump() 万能
} 

五、变量类型转换{
	字符串转换数字：从左到右截取，直到碰到不合法数字；      用法：$a=$a+3  $a='343fef'
 	数字转换字符串： 加个”.“拼接字符串                  用法：$a=$a.fef $a=23
	布尔型判断：除零、空为假，其余为真
}

六、变量赋值{
	传值赋值：给了你钱，别找我了                        用法：$wang=$li
	引用赋值：共用信用卡，相互影响                      用法：$wang=&$li
}
七、unset(变量)            变量销毁（销毁后不影响其他变量） 用法：if

八、动态变量                可以复用$ 调用上层变量值      用法：echo $$$变量名  
}
*/

/*
//作业：
$a='hello';
$b=&$a;
unset($b);
$b='world';
echo $a,$b;
*/

//二、变量是否存在
$a='yes';
$b=null;
$c=12;
if (isset($a,$b,$c)) {
	echo '都存在';
}
else{
	echo '部分不存在';
}
echo '<br />';

//三、显示变量类型
echo gettype($a);
echo '<br />';

//检测单一变量类型
if(is_int($c)) {
	echo '是该类型';
}
else{
	echo '不是该类型';
}
echo'<br/>';

//四、输出变量方式
echo $a,$b,$c,'<br/>';
print_r($a);
echo '<br />';
var_dump($a,$b,$c);
echo '<br/>';

//五、变量类型转换
//字符串转换数字
$d='123fd';
$d=$d+456;
echo $d,'<br/>';
//数字转换字符串
$f=520;
$f=$f.'abc';
echo $f,'<br/>';

//六、变量赋值
//传值赋值
$a=$c;
echo $a,'<br />';
//引用赋值
$b=&$c;
echo $c,$b,'<br/>';

//七、销毁变量
unset($b);
echo $c,'<br/>';

//八、动态变量
$hongchao='man';
$painter='hongchao';
$cancer='painter';
echo $$cancer,' is a ',$$$cancer,', also is a ',$cancer;

?>
