@extends('blade.parent')
@section('title','重写标题')
@section('left')
	<h1>继承后修改的内容</h1>
	@parent
@endsection

@section('right')
	<p class="text-danger">this is right.</p>
@endsection