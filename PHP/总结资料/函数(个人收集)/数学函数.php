<?php 

/**---目录---
	1.求三值最大
	2.数字以千位数形式表示
**/

/**
 * 求三值最大
 * @param $a int 第一个数值
 * @param $b int 第两个数值
 * @param $c int 第三个数值
 * @return int 返回最大值
 **/

function maximum($a,$b,$c){
	return $a>$b ? ($a>$c ? $a : $c) : ($b>$c ? $b : $c);
}


/**
 * 数字千位数形式表示 或函数 number_format();
 * @param $str string 长数字字符串
 * @return $str string 千位形式数字字符串
 **/

function qian($str){
	//字符串反转 0987654321
	$str = strrev($str);
	//三位一次分割字符串 098,765,432,1,
	$str = chunk_split($str,3,',');
	//在次反转 ,1,234,567,890
	$str = strrev($str);
	//去除前面字符 1,234,567,890
	$str = ltrim($str,','); 
	return $str;
}
?>