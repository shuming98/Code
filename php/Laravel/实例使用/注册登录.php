<?php 
一、注册Register
0.写路由:
	Route::get('register','Auth\RegisterController@showRegistrationForm');
	Route::post('register','Auth\RegisterController@register');

1.注册登录模板要放在Auth目录下

2.控制器在app/Http/Controllers/Auth/RegisterController.php
	①成功后跳转页面：protected $redirectTo = '/home';
	②自动验证：protected function validator(array $data){}
	③写入数据库：protected function create(array $data){}

二、登录Login
0.写路由:
	Route::get('login','Auth\LoginController@showLoginForm')->name('login');
	Route::post('login','Auth\LoginController@login');
	Route::get('logout','Auth\LoginController@logout');

1.控制器在app/Http/Controllers/Auth/LoginController.php
	①成功后跳转页面：protected $redirectTo = '/home';
	②重写方法：

		public function username(){
	      return 'name'; //登录用户字段
	    }

	(3)写手动验证代码(use Auth)：

		public function register(){
	      if(Auth::check()){
	        return redirect('/');
	      }else{
	        if(!Auth::attempt(['name'=>$_POST['name'],'password'=>$_POST['password']])){
	          return back();
	        }else{
	          return redirect('/home');
	        }
	      }
	    }

	    public function logout(){
	      Auth::logout();
	      return redirect('/home');
	    }
?>