<?php  
//一、在对POST、GET做递归安全转义时用到
//①一个多维数组，如果单元值为数字，则把其值修改为原来2倍。
function arr_2($arr){
	foreach($arr as $key=>$value){
		if(is_numeric($value)){
			$arr[$key]=$value*2;
		}
		if(is_array($value)){
			$arr[$key]=arr_2($value);
		}
	}
	return $arr;
}
$array=array(1,2,3,'b',array(4,5,array('a',10,22,33,array(c,d,e))));
print_r(arr_2($array));
echo '<br/>';
//二、项目中经常按/年/月/日格式来创建目录，并备份或上传文件
//②递归创建级联目录(递归创建文件)，如给定‘/a/b/c/d/e’,而/a不存在，需要递归创建。
function create_dir($path){
	if(is_dir($path)){
		return true;              //返回true表示‘已存在’，不需要创建目录,'/Users/shuming/a'会返回false
	}
	if(@!is_dir($path)){              //@ 屏蔽警告报错
		create_dir(dirname($path));  //dirname 返回当前有效目录路径
		mkdir($path);
	}
}
$path='/Users/shuming/a/b/c/d/e';
//create_dir($path);

function create_dir_2($path){
	 return is_dir($path) ? true : (create_dir_2(dirname($path)) ? mkdir($path) : false); 
	 //另一种写法：一行搞定活用三目运算符简洁写法
}

@mkdir('/Users/shuming/www/l/j/k',0777,true);  
//mkdir 本身提供递归创建，mkdir(路径,权限,递归)

//三、在后台管理系统中，会经常批量删除某个目录
//③递归删除目录，如给定‘./a’,则把a目录及下级子目录，全删除
function remove_dir($path2){			
	if(!is_dir($path2)){    
	//如果只是删除空目录,这样写就可以了，如果要删除非空目录(含有文件),需要修改为if(!is_dir($path2) && @!unlink($path2))
		echo '文件不存在或目录非空';
		return false;
	}
	if(($path2==='.')||($path2==='..')){
		echo '请不要删除当前或父级目录。';
		return false;
	}
	if(is_dir($path2)){
	$df=opendir($path2);
	while(@false !== ($file=readdir($df))){
		if(($file !== '.') && ($file !== '..')){
			remove_dir($path2.'/'.$file);
		}
	}
	closedir($df);
}
	@rmdir($path2);
}
$path2='/Users/shuming/a';
//remove_dir($path2);

//四、无限级分类(表单省市区)
//④如，给定如下数组，要求写出函数得到地区下的子孙地区
$area=array(
	array('id'=>1,'area'=>'广东省','pid'=>0),
	array('id'=>2,'area'=>'上海市','pid'=>0),
	array('id'=>3,'area'=>'浦东新区','pid'=>2),
	array('id'=>4,'area'=>'金桥镇','pid'=>3),
	array('id'=>5,'area'=>'佛山市','pid'=>1),
);
//print_r($area);
function contact($arr,$num,$t){
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]['pid']===$num){
			echo str_repeat('---',$t),$arr[$i]['area'],'<br/>';
			contact($arr,$arr[$i]['id'],$t+1);
		}
	}
}
contact($area,0,0);
?>