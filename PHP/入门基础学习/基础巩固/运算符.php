<?php 
/*
一、算术运算符：+,-,*,/,%(负数取余时，结果正负看“除数”)
二、比较运算符：>,<,>=,==,===(类型和值均要相等)
三、三元运算符:$a>=$b?$a:$b;(无论你要比较多少个数，我都能找出最大值)
四、逻辑运算符:&&且, ||或,
五、递增递减运算符:b++(先返回b值，再+1),++b(先+1，再返回b值)
六、字符串运算符:.,echo $a.$b;
七、赋值运算符:$a=3;(赋值两个作用：一是把3赋给$a,二是返回运算结果3)
*/
/*
算术运算符取余
$a=-5;
$b=23;
$c=-23;
echo $b%$a,'<br/>',$c%$a,'<br />';
*/

/*
三元运算符
$a=224;
$b=52;
$c=21;
$d=2;
$z=4556;
$e=$a>=$b?$a:$b;
$f=$c>=$d?$c:$d;
$x=$e>$f?$e:$f;
var_dump($z>$x?$z:$x);
*/

/*
递增递减运算符
$a=23;
$b=--$a;//(把--$a赋给$b,先减后赋)
$c=$a--;//（把$a--赋给$c,先赋后减）
echo $a,'<br />',$b;
*/

 ?>