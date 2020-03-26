<?php
十、验证码
①下载captcha类:composer require gregwar/captcha

②Controller:
	use Gregwar\Captcha\CaptchaBuilder;
	use App\Rules\captcha;
	use Sesssion;

	//生成验证码
	public function captcha(){
		//创建验证码
		$builder = new CaptchaBuilder;
		$builder->build();

		//保存字符至session
	    session(['yzm',strtoupper($builder->getPhrase())]);

		//验证码输出至模板
		header('Content-type: image/jpeg');
		$builder->output();
	}

	//表单验证‘验证码’
	public function Post(){
		$this->validate(request(),[
			'imgcode'=>['required',new Captcha]
		]);
	}

③自定义验证码验证规则
	A.php artisan make:rule Captcha

	B.位置：App\Rules\Captcha.php
		class Captcha implements Rule
		{
		    public function passes($attribute, $value)
		    {
		        return strtoupper($value) === session('yzm');
		    }

		    public function message()
		    {
		        return '验证码不正确';
		    }
		}

④View:
//验证码表单 
<div>
    <input name="imgcode" id="imgcode" type="text">
    <img src="{{url('captcha')}}" name="imgc" id="imgc">

    @if($errors->has('imgcode'))
    <p>{{$errors->first('imgcode')}}</p>
    @endif
</div>

//jQuery更换验证码
$("#imgc").click(function(event){
    this.src = this.src + '?';
});

⑤Route:
Route::get('captcha',Controller@captcha);
?>