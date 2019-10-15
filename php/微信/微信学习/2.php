<?php 
/**
 * 人脸识别
 * @var [type]
 */
$data = [
	'api_key'=>'Y_qKKCsiLu5V2EK-2bIWKK09fdQvT0oR',
	'api_secret'=>'RJ0qqDwcH-uEAM5WlUfMBT7sgjPXbzdJ',
	'image_url'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1570277963310&di=f0140b0df12b5dcedfcb68c944823273&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201808%2F18%2F20180818075212_hwhca.thumb.700_0.jpg',
	'return_landmark'=>'1',
	'return_attributes'=>'age,gender,beauty'
];

$url = 'https://api-cn.faceplusplus.com/facepp/v3/detect';

$curl = curl_init();

curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_HEADER,0);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

$data = curl_exec($curl);

curl_close($curl);

$arr = json_decode($data,true)['faces'];
$num = count($arr);
$contentStr = '这里有'.$num."个人\n";
foreach($arr as $k=>$v){
	$contentStr .= '第'.($k+1).'个人:'.'性别是'.$v['attributes']['gender']['value'].',年龄是'.$v['attributes']['age']['value'].'岁,颜值为'.$v['attributes']['beauty']['male_score']."分\n";
}
echo $contentStr;
 ?>
