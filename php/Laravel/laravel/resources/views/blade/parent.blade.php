<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="container">
	<header class="bg-primary">头部</header><!-- /header -->
	<h1>@yield('title')</h1>
	<div>
		<div class="left">
			@section('left')
			内容
			@show
		</div>
		<div class="right">
			@yield('right')
			内容
		</div>
	</div>
	<footer class="bg-danger">尾部</footer>
</body>
</html>