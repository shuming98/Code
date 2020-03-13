<?php 
/**---目录---
	1.输出目录下所有文件和文件夹名（两层）
	2.获取一个网页地址的内容
	3.两个文件路径的相对路径
**/

/**
 * 输出目录下所有文件和文件夹名（二层）
 * @param $dir string 目录路径 xxx
 * @return $files array 目录下所有的文件和文件夹名
 **/

function my_scandir($dir){
	$files = array();
	if($handle = opendir($dir)){
		while(($file = readdir($handle)) !== false){
			if($file != '.' && $file != '..'){
				if(is_dir($dir . "/" . $file)){
					$files[$file] = scandir($dir . "/" . $file);
				}else{
					$files[] = $file;
				}
			}
		}
		closedir($handle);
		return $files;
	}
}

/**
 * 获取一个网页地址的内容 或 file_get_contents($url)
 * @param $string url 完整的url地址
 * @return string 网页内容
 **/

function wget_content($url){
	$readcontents = fopen($url,"rb");
	$contents = stream_get_contents($readcontents);
	fclose($readcontents);
	return $contents;
}


/**
 * 生成空数组R，找出A和B相同的部分，填充R为'..'（$len-$n）次，取出A不相同部分和R合并，R转化为字符串
 * 找到$b相对于$a的相对路径($b找$a)
 * @param $a string 文件路径
 * @param $b string 文件路径
 * @return returnPath string 返回$b到$a的相对路径 
 **/

function getRelativePath($a,$b){
	$arrA = explode('/',$a);	      //6
	$arrB = explode('/',dirname($b)); //5
	for($n = 1,$len = count($arrB);$n<$len;$n++){
		if($arrA[$n] != $arrB[$n]){
			break;
		} 
	}
	if($len - $n >0){ // 5-3 >0
		$returnPath = array_fill(1,$len - $n,'..');
	}
	$returnPath = array_merge($returnPath,array_slice($arrA,$n));
	return implode('/',$returnPath);
}

//getRelativePath('/a/b/c/d/e.php','/a/b/12/34/c.php')

/**
 * 创建多级目录
 * @param  string  $path  文件路径
 * @param  integer $chmod 文件权限
 * @return string         返回信息
 */
function createDir($path,$chmod=0777){
	if(is_dir($path){
		echo '文件已存在';
	}else{
		if(mkdir($path,$chmod,true)){
			echo '创建成功';
		}else{
			echo '创建失败';
		};
	}
}

?>