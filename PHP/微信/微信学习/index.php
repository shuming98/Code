<?php
/**
 * 1.接受用户数据(消息)(POST->xml数据包->转化为对象->取键)
 */

//接受数据
$postStr = file_get_contents('php://input');
//转换为对象
$postObj = simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);

//写入文件保存
//file_put_contents('./a.txt', $postObj->Content,FILE_APPEND);


/**
 * 回复消息
 */

//发送方账号
$toUser = $postObj->FromUserName;
//开发者微信号
$fromUser = $postObj->ToUserName;

$keyWords = $postObj->Content;

$time = time();

//文本
$textTpl="<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";

//音乐
$musicTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
  </Music>
</xml>";

$newsTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <ArticleCount>%s</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item>
  </Articles>
</xml>";

//回复
//echo $textTpl;

/**
 * 针对不同消息(文本、图片、语音)回复
 */
//消息类型：事件
if($postObj->MsgType == 'event'){
	//关注回复
	if($postObj->Event == 'subscribe'){
		$msgType = 'text';
		$contentStr = 'Hello world!';
		$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
	}elseif($postObj->Event == 'CLICK'){
		//点击回复
		if($postObj->EventKey == 'php'){
			$msgType = 'text';
			$contentStr = 'php是世界上最好的语言，这是一个玩笑话。';
			$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
			echo $res;
		}
	}
}

//文本关键词回复
if($postObj->MsgType == 'text'){
	if($keyWords == 'hello'){
		$msgType = 'text';
		$contentStr = '你好?';
		$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
	}elseif($keyWords == 'music'){
		//回复音乐
		$msgType = 'music';
		$title = '优雅的音乐';
		$des = 'this is a beautiful music';
		$url = "http://fs.open.kugou.com/a463466e1774cccfa58cf687b099b1c2/5d994e5d/G006/M02/05/14/Rg0DAFS2xxSAHzyFAEWzEq3F8_E903.mp3";
		$res = sprintf($musicTpl,$toUser,$fromUser,$time,$msgType,$title,$des,$url,$url);
		echo $res;
	}elseif($keyWords == 'news'){
		//回复图文消息
		$msgType = 'news';
		$title = '文本消息';
		$desc = '当普通微信用户向公众账号发消息时，微信服务器将POST消息的XML数据包到开发者填写的URL上。';
		$url = 'http://www.baidu.com';
		$picurl = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1570339797704&di=f2e6f38caeb802dc4d4d0809a78c0a9f&imgtype=0&src=http%3A%2F%2Fwww.enkj.com%2Fidcnews%2Fkindeditor-4.1.7%2Fattached%2Fimage%2F20151009%2F20151009175632_7788.png';
		$res = sprintf($newsTpl,$toUser,$fromUser,$time,$msgType,1,$title,$desc,$picurl,$url);	
		echo $res;
	}else{
		$msgType = 'text';
		$contentStr = '欢迎光临';
		$res = sprintf($newsTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
	}
}elseif($postObj->MsgType == 'image'){
		/**
		 * face++ 人脸识别
		 */
		$data = [
			'api_key'=>'Y_qKKCsiLu5V2EK-2bIWKK09fdQvT0oR',
			'api_secret'=>'RJ0qqDwcH-uEAM5WlUfMBT7sgjPXbzdJ',
			'image_url'=>$postObj->PicUrl,
			'return_landmark'=>'1',
			'return_attributes'=>'age,gender,beauty'
		];
		//curl POST请求
		$url = 'https://api-cn.faceplusplus.com/facepp/v3/detect';
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_HEADER,0);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		$data = curl_exec($curl);
		curl_close($curl);
		//json数据转数组
		$arr = json_decode($data,true)['faces'];
		$num = count($arr);
		//判断图片是否为人物
		if($num == 0){
			$contentStr = '你的图片不是人物!';
		}else{
			$contentStr = '这里有'.$num."个人\n";
			foreach($arr as $k=>$v){
				$contentStr .= '>>第'.($k+1)."个人:\n".'性别是'.$v['attributes']['gender']['value'].",\n年龄是".$v['attributes']['age']['value']."岁,\n颜值为".$v['attributes']['beauty']['male_score']."分。\n";
			}
		}
		$msgType = 'text';
		$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
}elseif($postObj->MsgType == 'voice'){ 
		$msgType = 'text';
		$contentStr = '你的声音真好听';
		$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
}elseif($postObj->MsgType == 'location'){
		//获取定位周边信息
		$url ='http://api.map.baidu.com/place/v2/search?query=美食&location='.$postObj->Location_X.','.$postObj->Location_Y.'&radius=2000&output=json&scope=2&ak=88H9M1sNCCGGWVz7A3VZjq6xCSLx6Va5';
		$json = file_get_contents($url);
		//json转数组
		$arr = json_decode($json,true)['results'];
		$contentStr = '';
		foreach($arr as $k=>$v){
			$contentStr .= '>>>'.$v['name'].'在'.$v['address'].'距离你有'.$v['detail_info']['distance']."米\n";
		}
		$msgType = 'text';
		$res = sprintf($textTpl,$toUser,$fromUser,$time,$msgType,$contentStr);
		echo $res;
}
 ?>

