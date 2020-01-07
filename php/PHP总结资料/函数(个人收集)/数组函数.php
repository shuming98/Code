<?php 
/**---目录---
	1.对二维数组进行排序
	2.从二维数组中取出一段转成新的二维数组
	3.随机抽奖
	4.冒泡排序
**/


/**
 * 对二维数组进行排序
 * @param $arr array 待排序的二维数组
 * @param $row string 排序依据的列
 * @param $type string 排序类型asc or desc
 * @return $array_temp array 以列为键并排好序的二维数组
 **/

function array_sort($arr,$row,$type = 'asc'){
	//构造一个空数组
	$array_temp = array();
	//把排序依据的列名作为键
	foreach($arr as $v){
		$array_temp[$v[$row]] = $v;
	}
	//调用排序函数，保持索引关系
	if($type == 'asc'){
		ksort($array_temp);
	}elseif($type == 'desc'){
		krsort($array_temp);
	}else{
		echo "程序出错";
	}
	return $array_temp;
}


/**
 * 从二维数组中取出一段转成新的二维数组
 * @param $arr array 二维数组
 * @return $arr array 提取好的二维数组
 **/

function change_array($arr){
	$arr_temp = array();
	$arr2 = array();
	//根据fid取出一维数组
	foreach($arr as $v){
		$arr_temp[$v['fid']][] = array_slice($v,1);
		//$arr_temp[$v['fid']][] = array('tid'=>$v['tid'],'name'=>$v['name']);
	}
	//赋值重构键值
	foreach($arr_temp as $v){
		$arr2[] = $v;
	}
	return $arr2;
}

$arr = array(
	'0'=>array('fid'=>1,'tid'=>1,'name'=>'Name1'),
	'1'=>array('fid'=>1,'tid'=>2,'name'=>'Name2'),
	'2'=>array('fid'=>1,'tid'=>5,'name'=>'Name3'),
	'3'=>array('fid'=>1,'tid'=>7,'name'=>'Name4'),
	'4'=>array('fid'=>3,'tid'=>9,'name'=>'Name5'),
);


/**
 * 随机抽奖
 * @param $arr array 成员名单
 * @param $num int 抽几个
 * @return $res string 中奖名单
 **/

function my_random($arr,$num = 1){
	$res = "";
	$cnt = array_rand($arr,$num);
	if(is_array($cnt)){
		foreach($cnt as $v){
			$res .=$arr[$v].'、';
		}
	}else{
		$res .= $arr[$cnt];
	}
	return $res;
}


/**
 * 冒泡排序，与sort()效果一样
 * @param $arr 一维数组
 * @return $arr 排序好的数组
 **/

function bubble_sort($arr){
	$n = count($arr);
	for($i=0;$i<$n-1;$i++){
		for($j=0;$j<$n-$i-1;$j++){
			if($arr[$j]>$arr[$j+1]){
				$new = $arr[$j];
				$arr[$j] = $arr[$j+1];
				$arr[$j+1] = $new;
			}
		}
	}
	return $arr;
}

?>