<?php
//一、数组声明方式              $变量名=array(key=>value);
/*$arr=array('001'=>'春','002'=>'夏','003'=>'秋','004'=>'冬',key=>value);
$arr=array(a=>3,b=>4,c=>5);
print_r($arr); 

//二、数组类型
①索引数组,键没有特殊意义，是纯数字 $arr=array(0=>'东',1=>'南',2=>'西',3=>'北');
②关联数组，键与值有联系          $arr=array('name'=>'小名','age'=>27,'place'=>'广东');
③多维数组                     $arr=array(0=>'a',1=>'b',2=>array(0=>'1c',1=>'2c',2=>array(0=>'3c_0')));

//三、键key规则         [键可以是整数和字符串，默认从0（或已存在数字）开始递增，键重复会覆盖]
①如果不声明，key会从0、1、2、3递增生成键；       $arr=arrary(a,b,c,d);
②如果已存在数字键，则从最大数字键递增生成；        $arr=array(3=>a,b,1=>c,d);
③如果键重复了，后面值会覆盖前面的                $arr=array(0=>a,b,c,0=>d);
④键可以是整数，也可以是字符串，但浮点数会转成整数，如果字符串内容恰好是整数，也会被理解成整数 

//四、操作数组单元
$arr=array(a,b,c,d);
①增加一个单元:$arr[key]='value';       $arr[]='';
②修改单元的值:$arr[key]='value';(key是已存在的键)
③删除某个单元:unset($arr[0]);          unset销毁变量  
④读取一个单元:echo $arr[3]; 

//五、遍历数组
①索引数组for遍历，key=0,1,2.......
$arr=array(a,b,c,d,e);
for($key=0;$key<count($arr);$key++){
	echo $arr[$key],'<br/>';
}

②关联数组foreach遍历($arr as $key=>$value)/($arr as $value)遍历，$key输出键，$value/$arr[$key]输出值
$arr=array('name'=>'小张','age'=>23,'city'=>'广东');
foreach($arr as $key=>$value){
	echo $key,'=>',$arr[$key],'==',$value,'<br/>';
}

③多维数组遍历for+foreach遍历
$arr=array(a,b,array(c,d,array(z,y,x,array(s,x,j,array(k,m,n)))),e,f,array(g,h,i));
foreach($arr as $key=>$value){
	echo $key,' ~ ',$value,'<br/>';         //先遍历一遍
	for($i=0;$i<count($arr);$i++){          //多维数组循环遍历
	if(is_array($value)){                   //判断value是否为数组
		foreach($value as $key=>$value){    //value是数组，再遍历一遍
			echo $i+2,'维数组:&nbsp&nbsp&nbsp',$key,' ~ ',$value,'<br/>';

	}	
	echo '<br/>';	
	}
	}
	}

//六、数组游标操作 current(数组),读取当前游标位置的值
$arr=array(1,2,3,4,5,6);
echo current($arr);     //读取当前位置的值 1
next($arr);             //往后移一位  2
end($arr);				//移到最后一个  6
prev($arr);				//往前移一位 5
reset($arr);			//(复原)移到第一个 1

//七、数组常用函数
count(array)      			  返回数组个数
is_array()                    判断数组是否存在
array_key_exists(key,array)   判断数组键是否存在
in_array(value,aray)		  判断数组值是否存在
sort()						  排序数组
array_merge(array1,array2...) 数组合并
array_intersect(1,2....)	  数组求交集
数组元素添加删除，不可设置key，key会重置{
	array_push(array,value,value.)     入栈,并返回数组长度   (栈：先进后出，后进先出)
	array_pop(array)			       出栈,并返回值
	array_unshift(array,value,value.)  往数组头部插入元素
	array_shift()                      删除数组头部单元
}
array_flip()				  键值交换
array_unique()                移除数组重复的值
array_reverse()				  数组翻转
array_sum()					  数组值求和
array_product()               数组值求积


$stu=array('lisi'=>3,'wang'=>5,'zhao'=>6);
foreach ($stu as $key => $value) {
	echo $key,'-',$value*2,'<br />';
}
*/
//数组函数
$arr=array(2=>mysql,1=>linux,apache,'bb'=>php,python,array(1,2,3,4));
$arr2=array(a,b,c,a);
$arr3=array(b,c,d);
$arr4=array(1,2,3,4,5);
var_dump(count($arr));
echo '<br/>';
var_dump(array_key_exists(6,$arr));
echo '<br/>';
var_dump(in_array(linux,$arr));
echo '<br/>';
sort($arr);
print_r($arr);
echo '<br/>';
print_r(array_merge($arr,$arr2,$arr3));
echo '<br/>';
print_r(array_intersect($arr2,$arr3));
echo '<br/>';
print_r(array_push($arr,vim,qq));
print_r($arr);
echo '<br/>';
print_r(array_pop($arr));
print_r($arr);
echo '<br/>';
print_r(array_shift($arr));
print_r($arr);
echo '<br/>';
print_r(array_unshift($arr,apache,qq));
print_r($arr);
echo '<br/>';
print_r(array_flip($arr));
echo '<br/>';
print_r($arr);
print_r(array_unique($arr2));
echo '<br/>';
print_r(array_reverse($arr2));
echo '<br/>';
print_r(array_sum($arr4));
echo '<br/>';
print_r(array_product($arr4));

//数组经典案例
echo '<hr>';
//有一只小羊，两年可以生一只小羊，四年可以生一只小羊，问20年后有多少只小羊？(0岁的羊，2岁和4岁都可以生小羊)

$yang=array(1,0,0,0,0);          //这里指0-4岁羊的数量
for($year=0;$year<20;$year++){
	$xiaoyang=$yang[1]+$yang[3]; //数组从0开始
	array_unshift($yang,$xiaoyang);
	array_pop($yang);
}
print_r($yang);
$sum=array_sum($yang);
echo '20年后有',$sum,'只小羊','<br/>';


//n只猴子围成一圈，顺时针报数，报到m的猴子出局，再从刚出局猴子下一位开始重新报数，如此重复，直至只剩下最后一只猴子就是大王。要求写出猴子数量n,报的最后一个数m,最后结果给出当选猴王的初始编号

function king($n,$m){            //写一个函数设定n,m
	$mk=range(1,$n);             //写一个数组范围
	$i=0;                        //设定i从0开始,与数组指针一样
	while(count($mk)>1){         //判断数组是否>1
		(($i+1)%$m!=0) && array_push($mk,$mk[$i]);  //假设$i就是要出局的猴子，把$i放数组最后被销毁
		unset($mk[$i]);	
		$i++;    //$i++循环
	}
	return $mk[$i];          //循环到最后一个数，返回值
}
echo '第',king(120,5),'只猴子是大王';
 ?>








