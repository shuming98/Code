<?php 
/**
 * 获取文件扩展名 
 * @param $path string 文件路径/文件名
 * @return string 文件扩展名
 **/

//查找'.'最后一次出现位置
function ext_name1($path){
	return strrchr($path,'.');
}

//查找'.'最后出现的位置
function ext_name2($path){
	return substr($path,strrpos($path,'.'));
}

//输出文件的后缀
function ext_name3($path){
	return pathinfo($path)['extension'];
}

//根据'.'分割文件名
function ext_name4($path){
	$arr = explode('.',$path);
	//return $arr[count($arr)-1];
	return array_pop($arr);
}

//正则
function ext_name5($path){
	$pattern = '/^[^\.]+\.([\w]+)$/';
	return preg_replace($pattern, '${1}',$path);
}

function ext_name6($path){
	$pattern = '/\.([\w]+)$/';
	preg_match($pattern,$path,$res);
	return $res[1];
}


/**
 * 获取url的文件名后缀
 * @param $url string 完整的URL地址
 * @return $res string 文件后缀
 **/
function getExt($url){
	$arr = parse_url($url);
	$res = strchr(basename($arr['path']),'.');
	return $res;
}



 ?>