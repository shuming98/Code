<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>讨论区看帖</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="forum_show_container">
		<!--用户信息-->
		<div class="forum_show_left">
			<h1>打开本地服务器调查APP出现以下错误，如何解决？</h1>
			<img src="../../images/icon/user.png" alt="">
			<p>梁伟</p><br/>
			<p>发表于：2019/5/30</p>
		</div>
		<div class="forum_show_right">
			<button>回复本帖</button>
			<button>点赞</button>
			<p>浏览:43&nbsp;&nbsp;回复:13&nbsp;&nbsp;点赞:5</p>
		</div>
		<div class="clearfix"></div>
		<div class="forum_show_content">
			<pre>500 （服务器内部错误） 服务器遇到错误，无法完成请求。
501 （尚未实施） 服务器不具备完成请求的功能。例如，服务器无法识别请求方法时可能会返回此代码。
502 （错误网关） 服务器作为网关或代理，从上游服务器收到无效响应。
503 （服务不可用） 服务器目前无法使用（由于超载或停机维护）。通常，这只是暂时状态。
504 （网关超时） 服务器作为网关或代理，但是没有及时从上游服务器收到请求。
505 （HTTP 版本不受支持） 服务器不支持请求中所用的 HTTP 协议版本。
<img src="../../images/icon/resource.png" alt="">
</pre>
		</div>
		<div class="forum_reply_content">
			<h1>全部回复(13)</h1>
			<div class="forum_one_reply">
				<img src="../../images/icon/user.png" alt="">
				<p>刘明</p><br/>
				<p>8小时前</p>
				<div class="clearfix"></div>
				<p>你压根就没有开启服务器。</p>
				<div class="clearfix"></div>
				<p style="float:right;"><a>赞</a>&nbsp;&nbsp;<a>回复(1)</a></p>
				<div class="clearfix"></div>
				<hr>
				<div class="forum_one_reply_one">
				<img src="../../images/icon/user.png" alt="">
					<p>秦林</p><br/>
					<p>10小时前</p><br/>
					<p>回复刘明：你在说什么？</p>
					<div class="clearfix"></div>
					<p style="float:right"><a>回复</a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>