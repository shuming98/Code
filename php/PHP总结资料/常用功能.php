<?php
//生成随机文件名按日期存储
$fname = rand(10000,99999);
$ext = strrchr($_FILES['pic']['name'],'.');
$path = './'.date('Y/m/d');
if(!is_dir($path)){
	mkdir($path,0777,true);
}
echo move_uploaded_file($_Files['pic']['tmp_name'],$path . '/' . $fname . $ext)?'ok':'fail';

//文件上传应用与项目
//生成随机字符串函数
function randStr($num=6){
	$str = str_shuffle('abcdefghijklmnpqrtsuvwrszABCDEFGHIJKLMNPQRTSUVWRSZ23456789');
	return substr($str,0,$num);
}

//创建目录
function createDir(){
	$path = '/upload/'.date('Y/m/d');
	$fpath = ROOT . $path;
	if(is_dir($path) || mkdir($fpath,077,true)){
		return $path;
	}else{
		return false;
	}
}

//获取文件后缀
function getExt($filename){
	return strrchr($fname,'.');
}

//判断是否有图片上传 且error是否为0
if(!($_FILES['pic']['name'] == '') && ($_FILES['pic']['error']==0)){
	$filename = createDir() . '/' . randStr() . getExt($_FILES['pic']['name']);
	if(move_uploaded_file($_FILES['pic']['tmp_name'],ROOT . $filename)){
		//$filename 插入mysql表中
		$sql['pic_path'] = $filename;
	}
}

//显示上传的图片
<img src="<?php echo $sql['pic_path']; ?>" alt="">

//php.ini 开启文件上传功能及相关配置

//引入gd库
//php.ini 去掉 php_gd2.dll 注释

//gd库(处理图片)
/**
 * 创建空白画布(指定宽高)
 * 创建颜料
 * 画图
 * 输出/保存
 * 销毁(释放资源)
 */

$pic = imagecreatetruecolor(200,300);
$color = imagecolorallocate($pic,255,0,0);
imagefill($pic,0,0,blue);  //色彩填充(油漆桶)
$rc = imageellipse($pic,100,150,200,300,$color);
imagepng($pic,'/t1.png');
imagedestroy($pic);

//生成验证码
$pic = imagecreatetruecolor(80,50);
$red = imagecolorallocate($pic,255,0,0);
$blue = imagecolorallocate($pic,127,127,127);
imagefill($pic,0,0,$red);
imagestring($pic,5,5,5,randStr(4),$blue);  //画字符
header('Content-type:image/png');
imagepng($pic);
imagedestroy($pic);

//水印
$big = imagecreatefromjpeg('url');
$small = imagecreatefrompng('url');
list($bw,$bh) = getimagesize('url'); //获得图片宽高
list($w,$h) = getimagesize('url')
imagecopymerge($big,$small,$bw-$w,$bh-$h,0,0,$w,$h,40); //水印
imagepng($big,'t2.png/url');
imagedestroy($big);
imagedestroy($small);

//缩略图
$big = imagecreatefromjpeg('url');
list($w,$h) = getimagesize('url');
$small = imagecreatetruecolor($w/2,$h/2);
imagecopyresampled($small, $big, 0, 0, 0, 0, $w/2, $h/2, $w, $h);

imagepng($small,'url');
imagedestroy($big);
imagedestroy($small); 

/**
 * 生成缩略图(原图路径，宽，高) 返回缩略图路径
 */
function makeThumb($oimg,$sw=200,$sh=200){
	$simg = dirname($oimg) . '/' .randStr() . '.png';

	$opath = ROOT . $omig;//原图路径
	$spath = ROOT . $simg;//小图路径

	$spic = imagecreatetruecolor($sw,$sh);//创建小画布
	$white = imagecolorallocate($spic,255,255,255);//填充背景为白色
	list($bw,$bh,$btype) = getimagesize($opath);//获得大图宽高类型
	$map = array(
		1=>'imagecreatefromgif',
		2=>'imagecreatefromjpeg',
		3=>'imagecreatefrompng',
		15=>'imagecreatefromwbmp'
	);
	if(!isset($map[btype])){
		return false;
	}
	$opic = $map[$btype]($opath);//根据类型选择函数

	$rate = min($sw/$bw,$sh/$bh);
	$zw = $bw * rate;
	$zh = $bh * rate;//最终宽高

	imagecopyresampled($spic, $opic, ($sw-$zw)/2, ($sh-$zh)/2, 0, 0, $zw, $zh, $bw, $bh);
	imagepng($spic,$spath);

	imagedestroy($opic);
	imagedestroy($spic);
	return $simg;
}

//http原理
//变量跨页面访问(识别用户登录)
setcookie('name','admin');//apache掉给浏览器一个暗号，下一次访问apache带着暗号来
print_r($_COOKIE);//第二次加载时才能访问到$_COOKIE

//cookie计数器
//设置cookie用setcookie,访问cookie用$_COOKIE
if(!isset($_COOKIE['num'])){
	$num = 1;
	setcookie('num',$num)
}else{
	$num = $_COOKIE['num'] + 1;
	setcookie('num',$num);
}
echo num;

//cookie详细操作及语法
//expire:默认会话,关掉浏览器就消失(以s算)
//path:有效路径
//domain:子域名生效
setcookie(name,value,expire,path,domain);
setcookie(名,值,有效期,有效路径,子域名生效);
setcookie('name','user',time()+60,'/','nglinux.xin');
//用户登录与退出
//验证成功setcookie,退出就销毁setcookie
$user['name'] = trim($_POST['name']);
$user['password'] = trim($_POST['password']);
$sql = "select * from user where name ='$user[name]' and password = '$user[password]'";
if(!mGetRow($sql)){
	echo '用户名或密码错误';
}else{
	setcookie('name',$user['name']);
	header('Location:url');
}

//检测用户是否登录
function acc(){
	return isset($_COOKIE['name']);
}

//在需要登录才能访问的页面里写
if(!acc()){
	header('Location:url');
	//跳转到登录页面或报信息‘请登录’
}

//退出登录(点退出时执行)
setcookie('name',null,0);
header('Location:url');

//浏览器自带功能cookie不安全,用户可以伪造
//cookie 与 session 是有关联的,cookie带着‘号码’,session箱子存在服务器端
session_start();
$_SESSION['name'] = 'admin';

session_start();
printf($_SESSION);

//SESSION语法细节
1.无法读取、修改、销毁都要先 session_start();
2.session销毁: $_SESSION = array(); session_destroy(); [销毁更彻底,包括文件]
3.session配置: php.ini

//cookie与session比较
存储地址：客户 服务器
存储类型：字符串数字 字符串数字数组对象
创建方式 setcookie $_SESSION
读取    $_COOKIE $_SESSION
销毁    setcookie(key,null,0) unset(),session_destroy()

//了解cookie
1.关闭cookie,session还能用吗？ 能用，地址栏可以传递
session.use_only_cookies = 0 //是否只用cookie来传递session（0不是 1是）
session.use_trans_sid = 1 //是否用地址栏传递session

2.一个域名下最多可设置多少个cookie及其大小? 火狐50/4097，ie50/4095，opera30/4096,webkit无限制/4097，大小4k左右/4096字节

//sql注入与防范
1.预防用户输入‘or 1 #‘登录成功，要对非法字符进行过滤,敏感字符\转义

//反斜线 转义字符串
function _addslashes($arr){
	foreach($arr as $k=>$v){
		if(is_string($v)){
			$arr[$k] = addslashes($v);
		}else if(is_array($v)){
			$arr[$k] = _addslashes($v);
		}
	}
}

2.地址栏参数是否合法 //失败判断
if(!$rs){
	echo '失败信息或跳转';
}
SQL语句预处理:prepare(公司基本使用)

//密码安全
md5(password+salt);
//登录验证改为
$sql = "select * from  user where name = '$user[name]'";
$row = mGetRow($sql);
if(md5(user['password'].$row['salt'] === $row[password])){
	setcookie('name',$user['name']);
	header('Location:url');
}

//cookie安全
//不能阻止用户伪造cookie,但可以检验cookie是否合法
//加密用户名
function cCode($name){
	$salt = require(ROOT . '/lib/config.php');
	return md5($name. '|' .$salt['salt']);
}
//登录设置cookie
setcookie('name',$user['name']);
setcookie(ccode,cCode($user['name']));

//检测cookie
function acc(){
	if(!isset($_COOKIE['name']) || !isset($_COOKIE['ccode'])){
		return false;
	}
	return $_COOKIE['ccode'] === cCode($_COOKIE['name']);
}

//session效率没有cookie高

//xss攻击与防范
//web开发:请把用户理解为都是坏人
//有用户填写的内容，都要防范(用户输入代码会对源码进行修改，对网站会造成攻击)
//把html标签转成实体字符
htmlspecialchars(str);
strip_tags()//过滤html标签
//正则检测数据是否合法
?>