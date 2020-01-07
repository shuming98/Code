<?php
require('../Upload类/Upload.class.php');
/**
* 缩略图类
* @autor PHPer
*/    
interface iImage {
    /**
    * 创建缩略图
    * @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:/www
    * @param int width 缩略后的宽
    * @param int height 缩略后的高
    * @return string 缩略图的路径 以web根目录/ 为起点
    */
    static function thumb($ori , $width=200 , $height=200);

    /**
    * 添加水印
    * @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:/www
    * @param string $water 水印图片
    * @return string 加水印的图片路径
    */
    static function water($ori , $water);

    /**
    * @return string 错误信息
    */
    static function getError();
}

class Img implements iImage{
    /**
    * 创建缩略图
    * @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:/www
    * @param int width 缩略后的宽
    * @param int height 缩略后的高
    * @return string 缩略图的路径 以web根目录/ 为起点
    */
    public static function thumb($ori , $width=200 , $height=200){
		//define('ROOT',__DIR__);
    	$absori = $ori;
    	$randString = (new Upload())->randStr();
    	
    	//图片保存路径
    	$path = dirname($ori) . '/' . $randString . '.png';

    	list($ow,$oh,$type) = getimagesize($absori);
    	
    	//支持的原图片格式
    	$map = array(
    		1 => 'imagecreatefromgif',
    		2 => 'imagecreatefromjpeg',
    		3 => 'imagecreatefrompng',
    		15 => 'imagecreatefromwbmp',
    	);

    	$func = $map[$type];
    	//创建大画布
    	$bim = $func($absori);

    	//创建小画布
    	$sim = imagecreatetruecolor($width,$height);
    	$white = imagecolorallocate($sim,255,255,255);
    	imagefill($sim,0,0,$white);

    	//生成缩略图
    	$rate = min($width/$ow,$height/$oh);
    	$rw = $ow * $rate;
    	$rh = $ow * $rate;
    	imagecopyresampled($sim,$bim,($width - $rw) / 2,($height - $rh) / 2,0,0,$rw,$rh,$ow,$oh);

    	//添加水印
    	// $wim = imagecreatefrompng('./2.png');
    	// list($wimw,$wimh) = getimagesize('./2.png');
    	// imagecopymerge($sim,$wim,$width - $wimw,$height - $wimh,0,0,$wimw,$wimh,40);

    	//保存缩略图
    	imagepng($sim,'./' . $path);

    	//echo self::water(substr($path,2),'2.png');

    	//销毁画布
    	imagedestroy($bim);
    	imagedestroy($sim);

    	//返回保存路径
    	return $path;
    }

    /**
    * 添加水印(只支持.png图片)
    * @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:/www
    * @param string $water 水印图片(显示原始大小)
    * @return string 加水印的图片路径
    */
    public static function water($ori , $water){
    	$randString = (new Upload())->randStr();
    	$path = dirname($ori) . '/' . $randString . '.jpeg';

    	//创建画布
    	$oim = imagecreatefrompng('./' . $ori);
    	$wim = imagecreatefrompng('./' . $water);

    	//取得原图片的宽高
    	list($oimw,$oimh) = getimagesize('./' . $ori);
    	list($wimw,$wimh) = getimagesize('./' . $water);

    	//添加水印
    	imagecopymerge($oim,$wim,$oimw - $wimw,$oimh - $wimh,0,0,$wimw,$wimh,40);

    	//保存图片
    	imagepng($oim,'./' . $path);
    	return $path;

    	//销毁画布
    	imagedestroy($oim);
    	imagedestroy($wim);
    }

    /**
    * @return string 错误信息
    */
    public static function getError(){
    	return self::error;
    }
}

$img = new Img();
//缩略图
echo $img->thumb('1.png');echo '<br/>';
//水印
echo $img->water('1.png','2.png');//当前目录下图片
?>
