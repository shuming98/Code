<?php
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
?>