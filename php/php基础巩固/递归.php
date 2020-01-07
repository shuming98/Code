<?php
//一、递归概念:调用自身
//如,从1加到$n;
function sum($n){
	if($n==1){
		return 1;
	}
	return $n+sum($n-1);
}
echo sum(999),'<br/>';

//二、递归技巧
//假设法:假设自己的函数已经完成，先写第一步，再写第二步。
//案例，打印出文件目录，以及其子目录。
function printdir($path,$lev=0){
	$df=opendir($path);
	while(($file=readdir($df))!==false){
		echo str_repeat('&nbsp&nbsp&nbsp&nbsp→',$lev).$file,'<br/>';
		if($file=='.' || $file=='..'){
			continue;
		}
		if(is_dir($path.'/'.$file)){
			printdir($path.'/'.$file,$lev+1);
		}
	}
	closedir($df);
}
#printdir('/Users/shuming/www/html');

//三、递归与static静态变量
//当你调用一个函数时，它会找到这个函数执行一遍，当你第二次调用时，它会继续找到这个函数再执行一遍，这两次函数调用都是独立的。
//如果你想第二次调用的函数与第一次有联系，可以使用静态变量static==>直接利用上一次调用函数的结果。
//案例，数组全部值相加。
$a=array(1,2,3,array(6,7,8,array(9,10,11,array(0))));
function addarr($arr){
	static $sum=0;
	foreach($arr as $value){
		if(is_array($value)){
			addarr($value);
		}else{
		$sum+=$value;
		}
	}
	return $sum;
}
echo addarr($a);
	?>
