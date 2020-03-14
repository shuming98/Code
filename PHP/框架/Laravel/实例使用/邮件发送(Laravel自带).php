<?php
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
?>