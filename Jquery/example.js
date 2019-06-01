//点击切换图片
function change(){
	if($("img").attr('src').indexOf('图片名1')>=0){
		$("img").attr('src','图片名2');
	}else{
		$("img").attr('src','图片名1');
	}
}