<?php 
$str = "his is a goods 5 history";
$str2 = "txt,pop,lol,LOL,APACHE.MYSQL,PHP";
$str3 = "你好,hello world,我 是 你";
$str4 = "working doing";

$patt = '/hi/';	//匹配字符
$patt2 = '/\bhi\b/'; //匹配单词
$arr = array('13252447314','123','13239428243','4406');
$patt3 = '/[0-9]{11}/'; //匹配集合
$patt4 = '/[a-zA-Z]+/';
$patt5 = '/\W+/'; //非数字字母下划线
$patt6 = '/\s/'; //空白字符
$patt7 = '/\b[a-z]?\b/';
$patt8 = '/\b[a-z]+\b|[0-9]+/';	//或者用法
$patt9 = '/(hi|i|good)s/';
$patt10 = '/h.+s/'; //贪婪模式
$patt11 = '/h.+?s/'; //非贪婪模式
$patt12 = '/\b1[358]\d{9}\b/'; //匹配手机号
$patt13 = '/\b([a-zA-Z])\w+\1\b/'; //后向引用
$patt14 = '/\b(\d{3})\d{4}(\d{4})\b/'; //手机号替换中间4个数字
$patt15 = '/\b[a-z]+\b/i'; //不区分大小写
$patt16 = '/\b.+\b/s'; //单行模式,忽略回车 
$patt17 = '/[\x{4e00}-\x{9fa5}]/u'; //匹配中文
$patt18 = '/\b([a-z]+)ing\b/';
$patt19 = '/\b\w+(?=ing\b)/';
preg_match_all($patt19,$str4,$res);
var_dump($res);echo '<br/>';
var_dump(preg_split($patt5, $str));echo '<br/>';//正则分割字符串
var_dump(preg_replace($patt14,'\1****\2',implode(',',$arr)));echo '<br/>';//正则搜索和替换

//curl实现网络请求 curl抓内容，正则搜索
$th = curl_init();	//打开
curl_setopt($th,CURLOPT_URL,"https://www.baidu.com");	//设置
curl_setopt($th,CURLOPT_RETURNTRANSFER,1); //返回字符串(整个网页静态代码)
curl_setopt($th,CURLOPT_HEADER,0);	//返回http头
$res = curl_exec($th);		//执行
curl_close($th);	//关闭
var_dump($res);

//json
$arr2 = array('name'=>'laowang','age'=>'21');
$json = '{"name":"wsm","age":"21"}';
echo json_encode($arr2),'<br/>';
var_dump(json_decode($json,true));echo '<br/>';

?>
