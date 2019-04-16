<?php 
/***
 * php函数文件
 ***/

/**
 * 获取来访者IP
 * @return IP
 */

function getRealIp(){
	static $realip = null;
	if($realip != null){
		return $realip;
	}

	if(getenv('REMOTE_ADDR')){
		$realip = getenv('REMOTE_ADDR');
	}else if(getenv('HTTP_CLIENT_IP')){
		$realip = getenv('HTTP_CLIENT_IP');
	}else if(getenv('HTTP_X_FROWARD_FOR')){
		$realip = getenv('HTTP_X_FROWARD_FOR');
	}
	
	return $realip;
}

/**
 * 分页代码(显示5个页码)    
 * $current-2 $current-1 $current $current+1 $current+2   
 * @param int $sum 资源总数
 * @param int $current 当前显示的页码数
 * @param int $num 每页显示的数量
 * @return 5个页码 1 2 3 4 5
 */

function getPage($sum,$current,$num){
	$max = ceil($sum/$num); //最大页码数
	$left = max(1,$current-2);//最左侧页码
	$right = min($left+4,$max);//最右侧页码
	$left = max(1,$right-4);

	$page = array();
	for($i=$left;$i<=$right;$i++){
		$_GET['page'] = $i;
		$page[$i] = http_build_query($_GET);
	}
	return $page;
}

/**
 * 生成随机字符串
 * @param int num 生成随机字符串的长度
 * @return $str 一个随机字符串
 */

function randStr($num=7){
	$str = str_shuffle('abcdefghjkmnopqrstuvwsyzABCDEFGHJKMNOPQRSTUVWSYZ023456789');
	return substr($str,0,$num);
}

/**
 * 创建目录(用于保存上传的用户头像)
 * ROOT . '/upload/user_pic/2019/04/jike.docs'
 * @return $path 文件路径
 */
function createUserPicDir(){
	$path = '/upload/user_pic/'.date('Y/m');
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	}else{
		return false;
 	}
}

/**
 * 创建目录(用于保存上传的课程资源文件)
 * ROOT . '/upload/user_pic/2019/04/jike.docs'
 * @return $path 文件路径
 */
function createCourseResourceDir(){
	$path = '/upload/course_resource/'.date('Y/m/d');
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	}else{
		return false;
 	}
}

/**
 * 创建目录(用于保存上传的文件)
 * ROOT . '/upload/2019/04/16/jike.docs'
 * @return $path 文件路径
 */
function createDir(){
	$path = '/upload/'.date('Y/m/d');
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	}else{
		return false;
 	}
}

/**
 * 获得文件后缀
 * @param $filename 文件名
 * @return 文件后缀 如.jpg
 */
function getExt($filename){
	return strrchr($filename,'.');
}

/**
 * 生成缩略图(应用于论坛发帖)
 * @param str $oimg 原图相对url
 * @param int $sw 缩略图的宽
 * @param int $sh 缩略图的高
 * @return str $simg 缩略图路径
 */

function makeThumb($oimg,$sw=200,$sh=200){
	$simg = dirname($oimg) . '/' . randStr() . '.png';//缩略图存放路径
	$opath = ROOT . $oimg;//原图绝对路径
	$spath = ROOT . $simg;//缩略图绝对路径

	$spic = imagecreatetruecolor($sw, $sh);//缩略图大小
	$white = imagecolorallocate($spic, 255,255,255);
	imagefill($spic,0,0,$white);//填充背景色
	list($bw,$bh,$btype) = getimagesize($opath);
	$map = array(
		1=>'imagecreatefromgif',
		2=>'imagecreatefromjpeg',
		3=>'imagecreatefrompng',
		15=>'imagecreatefromwbmp'
	);
	if(!isset($map[$btype])){
		return false;
	}
	$opic = $map[$btype]($opath);//创建大图资源

	$rate = min($sw/$bw,$sh/$bh);
	$zw = $bw * $rate;
	$zh = $bh * $rate;//最终缩略图的宽高

	imagecopyresampled($spic, $opic, ($sw-$zw)/2, ($sh-$zh)/2, 0, 0, $zw, $zh, $bw, $bh);//生成缩略图
	imagepng($spic,$spath);//输出缩略图
	imagedestroy($spic);
	imagedestroy($opic);//销毁图象

	return $simg;
}

/**
 * 加密用户名
 * @param str $name 用户名
 * @return str md5(用户名+salt)=>md5码
 */

function md5Code($name){
	$salt = require(ROOT . '/lib/config.php');
	return md5($name . '|' . $salt['salt']);
}

/**
 * 检测用户是否登录 name需要更改
 */

function access(){
	if(!isset($_COOKIE['user_account']) || !isset($_COOKIE['md5Code'])){
		return false;
	}
	return $_COOKIE['md5Code'] === md5Code($_COOKIE['user_account']);
}

?>