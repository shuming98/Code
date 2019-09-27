<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css ">
</head>
<body class="container">
	<h1>Blade</h1>
	<h2><?php echo $data2['title']; ?></h2>
	<!-- 判断 -->
	<h2>{{$data2['score']}}</h2>
	@if($data2['score'] >=60)
	<h6 class="text-success">及格</h6>
	@else
	<h6 class="text-danger">不及格</h6>
	@endif
	<!-- 除非 -->
	@unless($data2['score']>=60)
	<h5 class="text-danger">不及格</h5>
	@endunless
	<!-- 判断变量是否存在 -->
	@isset($data2['score'])
	<p class="text-primary">存在</p>
	@endisset
	<!-- 判断变量是否为空 -->
	@empty($data['score'])
	<p class="text-primary">为空</p>
	@endempty
	<!-- switch选择语句 -->
	@switch($data2['id'])
		@case(1)
		<p>this is one.</p>
		@break
		@case(2)
		<p>this is two.</p>
		@break
		@default
		<p>this is other value.</p>
		@break
	@endswitch
	<!-- for循环 -->
	@foreach($num  as $v)
	<p class="text-info">{{$v}}</p>
	@endforeach
	<!-- 如果不确定有没数据使用forelse -->
	@forelse($num as $v)
	<p>商品为{{$v}}</p>
	@empty
	<p>暂无商品</p>
	@endforelse
	<!-- php原生 -->
	@php
	$a = 3;
	echo $a;
	@endphp
</body>
<!-- 引入重复模板 -->
@include('blade.footer')
</html>	