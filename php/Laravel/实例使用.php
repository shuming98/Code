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

三、数据库事务(一表提交多表同步)
0.引入相关Model和类：use App\Model;use DB;use Auth;
1.Model.php：
	//允许添加的字段
	protected $fillable = ['field','field'...];
2.添加——相应代码：
	//登录后获取用户的信息
	$user = Auth::user();
	//$user = request()->user();
	
	//开启事务
	DB::beginTransaction();

	//执行并异常处理
	try{ //一个表一个try..catch..
		$pro = Pro::create([  //Pro是Model
			//字段插入的内容
			'uid'=>$user->uid,
			'money'=>request('money')*100,
			'mobile'=>request('mobile'),
			'pubtime'=>time()
		]);
	}catch(\Exception $e)
	{
		//报错回滚
		DB::rollback();
		throw $e;
	}

	try{ //副表
	$att = Atts::create([
		'pid'=>$pro->pid,
		'uid'=>$user->uid,
		'age'=>request('age')
	]);
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}

	//提交事务
	DB::commit();
	return 'Success';

3.修改——相应代码
	$pro = Pro::find($pid);
	$att = Atts::where('pid',$pid)->first(); //先查

	DB::begintransaction();

	try{
		$pro->title = request('title'); //再修改
		$pro->save();
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}


	try{
		$att->title = request('title');
		$att->save();
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}

	DB::commit();
	return redirect('prolist');

四、利用中间件——注册后发送邮件[邮件发送实现]
1.下载nette/mail：composer require nette/mail
2.观看文档使用:
public function handle($request, Closure $next)
{
    $res = $next($request);

	/**
	 * 发送邮件
	 */
	use Nette\Mail\Message;

	$mail = new Message;
	$mail->setFrom('Nick <john@example.com>')//你的email

		//->addTo($request->user()->email)从注册后登录方获取email
		
		->addTo('peter@example.com')//发送给谁(email)
		->setSubject('邮件标题')
		->setBody("邮件内容.");

		//->setHTMLBody('<b>Sample HTML</b> <img src="background.gif">');
		//->addAttachment('example.zip');

	/**
	 * 使用SMTP服务器
	 * @var [type]
	 */
		$mailer = new \Nette\Mail\SmtpMailer([
	        'host' => 'smtp.gmail.com',//修改服务商,qq/163/gmail等
	        'username' => 'john@gmail.com',//你登录邮箱账号
	        'password' => '*****',//邮箱密码，或开启SMTP服务并获取授权码
	        'secure' => 'ssl',
	        // 'context' =>  [
	        //     'ssl' => [
	        //         'capath' => '/path/to/my/trusted/ca/folder',
	        //      ],
	        // ],
	]);
	$mailer->send($mail);
	return $res;
}
3.路由应用：
Route::post('register','RegisterController@register')->middleware('email');

五、邮件发送(Laravel 自带)
0.配置文件 .env
	MAIL_DRIVER=smtp
	MAIL_HOST=smtp.163.com  //代理主机
	MAIL_PORT=25			//端口
	MAIL_USERNAME=gwng2019@163.com //邮件登录用户名
	MAIL_PASSWORD=a123456		   //邮件smtp授权密码
	MAIL_ENCRYPTION=null
	MAIL_FROM_ADDRESS=gwng2019@163.com //发送邮箱
	MAIL_FROM_NAME=古米有限公司		//随便写得昵称

1.控制器
1）
	use Mail;
	Mail::send('email.view',['name'=>'传参内容'],function($message){$message->to('who@qq.com')->subject('标题');});

2）
	①php atrisan make:mail SendMail

	②\Mail\SendMail.php
		public function build(){
		    return $this->view('emails.view')->with(['name'=>'传参内容']);}

	③控制器
		use App\MailSend;
		use Mail;
		Mail::to('who@qq.com')->send(new SendMail);

2.模板
	新建邮件模板：resource/views/email/view.blade.php

六、模板：用户登录判断
	①   @if(!Auth::user())
			未登录时
		@else
			登录时 你好，{{Auth::user()->name}}
		@endif

	或

	②  @guest
			未登录时
		@endguest

		@auth
			登录时
		@endauth

七、分页功能
1.Controller:
	//DB查出数据,n是每页显示数据条数,发给模板
	 $pages = DB::table('table')->paginate(n);
	        return view('view',compact('pages'));

2.View:
	//显示页码
	{{$pages->links()}}
	//追加参数
	->appends('cate'=>'1')
	//加密
	->fragment(str_random(40))

3.修改分页源码：php artisan vendor:publish --tag=laravel-pagination
	①位置：resource/vendor/pagination/default.blade.php

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

九、定时任务(artisan + crontab)
A.自定义artisan命令
	①php artisan make:command Grow
	②位置：App\Console\Commands\Grow.php

		class Grow extends Command
		{
			//命令名称
		    protected $signature = 'grow';
		    //命令描述
		    protected $description = 'Create a time task to finish pay';
		    //命令执行代码
		    public function handle()
		    {
		        $today = date('Ymd',time());
		        $tasks = DB::table('tasks')->where('enddate','>=',$today)->get();
		        foreach($tasks as $t){
		            $t = (array)$t;
		            $t['paytime'] = $today;
		            unset($t['tid']);
		            unset($t['enddate']);
		            DB::table('grows')->insert($t);
		        }
		    }
		}

	或③位置：/routes/console.php

Artisan::command('命令名称', function () {
    执行代码
})->describe('命令描述');

④查看命令:php artisan list

B.定时任务
	sudo crontab -e
	* * * * * (iHdmN) php /Path/app/artisan grow

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