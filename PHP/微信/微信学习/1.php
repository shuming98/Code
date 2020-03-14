<?php 
/**
 * 定位
 * @var string
 */
$url ='http://api.map.baidu.com/place/v2/search?query=美食&location=39.915,116.404&radius=2000&output=json&scope=2&ak=88H9M1sNCCGGWVz7A3VZjq6xCSLx6Va5';

$json = file_get_contents($url);

//json转数组
$arr = json_decode($json,true)['results'];
$contentStr = '';
foreach($arr as $k=>$v){
	$contentStr .= $v['name'].'在'.$v['address'].'距离你有'.$v['detail_info']['distance']."米\n";
}
echo $contentStr;
 ?>