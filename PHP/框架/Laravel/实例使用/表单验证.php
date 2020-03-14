<?php
八、表单验证
1.jquery简单验证
	$("#Form").submit(function(event){
	        var mobile = /1[35789]\d{9}/;
	        
	        if(!mobile.test($("#mobile").val())){
	            alert("手机号码：请输入正确的手机号");
	            return false;
	        }
	    });

2.Laravel验证

$this->validate($data|request(),'验证规则','自定义错误信息');

①Controller:
	A.自动验证
		public function FormPost(){
	    	$this->validate(request(),[
	            'age'=>'in:15,40,80',
	            'money'=>'required|integer|digits_between:5,7',
	            'mobile'=>'required|regex:/1[3578]\d{9}/'
	        ],
	        [
	        	'in'=>'必须选择',
	        	'money.required'=>'金额必填',
	        	'mobile.required'=>'手机号码必填'
	        ]);
	    }

    B.(或)手动验证
	    public function FormPost(){
	    	use Validator;
	    	$validator = Validator::make(request()->all(),
	    		[
	    			'mobile'=>'required'
	    		]);
	    	if($validator->fails()){
	    		return back()->withErrors($validator)->withInput();	
	    	}

	    }

②View:
	@if($errors->has('money'))
		<p>{{$errors->first('money')}}</p>
	@endif

③报错信息中文语言包
A.把中文语言包zh放在/resources/lang/下
B./config/app.php 修改 'locale' = 'zh'

3.表单授权验证(面对复杂验证情境中创建表单请求)
①php artisan make:request SendPost
②位置：App\Http\Requests\SendPost.php
	public function authorize()
    {
    	//验证授权
        return true;
    }

    public function rules()
    {
        return [
        	//验证规则
            'mobile'=>'required|regex:/1[35789]\d{9}/'
        ];
    }

    public function messages(){
        return [
        	//报错信息
            'mobile.required'=>'手机号码必须填'
        ];
    }

③Controller:
	public function store(SendPost $request)
    {
    	//Request 改成自定义的SendPost
    }

4.自定义验证规则(Laravel外的规则)
①php artisan make:rule SendMobile
②位置：App\Rules\SendMobile.php

    public function passes($attribute, $value)
    {
    	//定义规则
        $patt = '/1[3578]\d{9}/';
        return preg_match($patt,$value);
    }

    public function message()
    {
    	//定义报错信息
        return '手机字段不符合规则';
    }

③Controller://控制器使用
	use APP\Rules\SendMobile;

	public function store(Request $request)
	{
	    $request->validate([
	        'mobile'=>['required',new SendMobile]，
	    ]);
	}
?>