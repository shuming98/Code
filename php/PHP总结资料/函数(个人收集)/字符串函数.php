<?php 
/**---目录---
	1.截止字符串长度
	2.翻转中文字符串
	3.转换字符串为首字母大写
	4.获取客户IP并转为整型存储
	5.把长整型ip转化为ip形式输出
**/

/**
 * 截止字符串长度 或 substr()
 * @param $str string 要截取的字符串
 * @param $start int 从那个位置开始截取
 * @param $length int 截取字符串长度
 * @return string 截取后的字符串
 */

function substr_utf8($str,$start,$length = null){
	return join("",array_slice(preg_split("//u",$str,-1,PREG_SPLIT_NO_EMPTY),$start,$length));
}

/**
 * 翻转中文字符串
 * @param $str string 中文字符串
 * @return $str string 反转后的中文字符串
 */

function strrev_utf8($str){
	return join("",array_reverse(preg_split("//u", $str)));
}

/**
 * 把'open_door'转化为'OpenDoor'
 * @param $str string 字符串 
 * @return $str string 转换好的字符串
 **/

function change_str($str){
	//把字符串转化为一维数组
	$arr = explode('_',$str);
	//对数组的每个元素执行回调函数,首字母大写
	$arr = array_map('ucfirst',$arr);
	//把一位数组转化为字符串
	return implode('',$arr);
}

function change_str2($str){
	//_转化为' ',首字母大写，再去空格
	return str_replace(' ','',ucwords(str_replace('_',' ',$str)));
}


/**
 * 获取客户IP并转为整型存储
 * @return int ip的长整型
 **/

function getClientIP(){
	return sprintf("%u",ip2long($_SERVER["REMOTE_ADDR"]));
}

/**
 * 把长整型ip转化为ip形式输出
 * @param $ip int 长整型ip
 * @return str ip形式
 **/

function getRealIP($ip){
	return long2ip(sprintf("%d",$ip));
}
 ?>