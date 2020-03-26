<?php
0.微博开放平台注册
授权地址：http://qingfeng.wicp.vip/weibo/center

1.路由
Route::get('weibo/login','IndexController@login');
Route::get('weibo/center','IndexController@center');

2.前端微博登录按钮(View)
//login.blade.html
<form action="https://api.weibo.com/oauth2/authorize" method="post">
	{{csrf_field()}}
	<input type="hidden" name="client_id" value="3495392613">
	<input type="hidden" name="redirect_uri" value="http://qingfeng.wicp.vip/weibo/center">
	<input class="form-control" type="submit" value="微博登录">
</form>

3.后端代码(Controller)
	//前端页面
	public function login(){
    	return view('login');
    }

    //微博登录授权A-F过程：code->access_token->userInfo
    public function center(){
        //获取code[A-B]
		$code = $_GET['code'];
		//利用code，通过curl获取token
		$url = "https://api.weibo.com/oauth2/access_token";
		$data = [
			'client_id' => '3495392613',
			'client_secret' => 'e8c05b39fa0af824be575ac8ffa46221',
			'grant_type' => 'authorization_code',
			'code' => $code,
			'redirect_uri' => 'http://qingfeng.wicp.vip/weibo/center'
		];
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$output = curl_exec($ch);
		curl_close($ch);
		$arr = json_decode($output,true);
		//获取token[C-D]
		$access_token = $arr['access_token'];
		//根据用户ID获取用户信息[E-F]
		$uid = $arr['uid']; 
		$user = file_get_contents('https://api.weibo.com/2/users/show.json?access_token='.$access_token.'&uid='.$uid);
		echo $user;
    }
?>