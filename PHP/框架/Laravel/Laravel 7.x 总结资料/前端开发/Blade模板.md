---
# 目录
### 一、Blade模板
### 二、模板继承
### 三、显示数据
### 四、控制结构
### 五、表单
### 六、零散知识
### 七、组件
### 八、其他：堆栈、服务注入、Blade扩展
---

# 一、Blade模板

- Blade 是 Laravel 提供的一个简单而又强大的模板引擎。
- 所有 Blade 视图文件都将被编译成原生的 PHP 代码并缓存起来，除非它被修改，否则不会重新编译。
- Blade 视图文件使用 .blade.php 作为文件扩展名。
- 存放在 resources/views 目录

# 二、模板继承

## 1.引入头尾复用代码
    include('footer')
    //框架自动从/views/文件下查找

## 2.模板继承:省去多次引入相同部分

### ①定义布局(父模板)
    <body>
        <header>头部</header>
        <h1>@yield('title')</h1>  <!-- 定义某部分标题或内容 -->
        <div> 主体内容
            <div class="left">
                @section('left')  <!-- 定义某部分内容 -->
                @show
            </div>
            <div class="right">
                @yield('right')
                内容
            </div>
        </div>
        <footer>尾部</footer>
    </body>

        B.编写子模板继承并重写(@section)：
            @extends('blade.parent')    <!-- 继承父类模板 -->

            @section('title','重写标题') <!-- yield定义内容 -->
            
            @section('left')            <!-- @section()子模板内容@endsection -->
                <h1>继承后修改的内容</h1>
                @parent                 <!-- @parent显示父模板内容 -->
            @endsection

            @section('right')
                <p class="text-danger">this is right.</p> 
            @endsection

    ③复用组件(@component)
        A.父模板:<!-- alert.blade.php -->
            <div class="alert alert-danger">
                <div class="alert-title">{{$title}}</div>
                {{$slot}}
            </div>

        B.子模板：
            @component('alert')
                @slot('title')
                    Forbidden
                @endslot
                You are not allowed to access this resource!
            @endcomponent

# 三、显示数据

- {{$var}} ：即可显示数据，而且自动使用 htmlspecialchars 函数转义。
- {{time()}} :还可以显示函数结果，或放任意php代码。
- {{!!$var!!}} :不转义变量
- @json(array) :渲染JSON，把数组转成JSON格式。
- @{{var}} :不解析变量，避免和JS框架冲突
- @verbatim ..Code.. @endverbatim :指令内的代码不解析变量

# 四、控制结构

## 1.if语句
	@if (count($records) === 1)
	    我有一条记录！
	@elseif (count($records) > 1)
	    我有好多条记录！
	@else
	    我没有记录！
	@endif

## 2.unless除非语句
	@unless (Auth::check())
	    You are not signed in.
	@endunless

## 3.isset判断存在
	@isset($records)
	    // 变量 $records 已定义且不为空...
	@endisset

## 4.empty判断为空
	@empty($records)
	    // 变量 $records 为空...
	@endempty

## 5.用户认证
	@auth
	    // 用户身份已被验证…
	@endauth

	@guest
	    // 用户身份未被验证…
	@endguest


## 6.switch选择语句
	@switch($i)
	    @case(1)
	        First case...
	        @break

	    @case(2)
	        Second case...
	        @break

	    @default
	        Default case...
	@endswitch

## 7.for循环
	//常用
	@for ($i = 0; $i < 10; $i++)
		The current value is {{ $i }}
	@endfor

	//遍历
	@foreach ($users as $user)
		<p>This is user {{ $user->id }}</p>
	@endforeach

	//遍历时，需要写数据不存在时的情况
	@forelse ($users as $user)
	    <li>{{ $user->name }}</li>
	@empty
	    <p>No users</p>
	@endforelse

	//嵌套循环，$loop 变量在循环内部可用
	//包含一些属性，如访问索引，父循环、奇偶/第一/最后迭代
	@foreach ($users as $user)
	    @foreach ($user->posts as $post)
	        @if ($loop->parent->first)
	            This is first iteration of the parent loop.
	        @endif
	    @endforeach
	@endforeach

## 8.while循环
	@while (true)
	    <p>I'm looping forever.</p>
	@endwhile

## 9.contine/break
循环可用 @continue or @break ,且能声明条件:

	@continue
	@continue($user->type == 1)

	@break
	@break($user->number == 5)

# 五、表单

## 1.每块表单都需加的令牌
	<form action="/profile" method="POST" >
	    @csrf
	    ...
	</form>

## 2.表单使用其他请求方式
	<form action="/foo/bar" method="POST">
	    @method('PUT')
	    ...
	</form>

## 3.错误验证
	<input id="title" type="text" class="@error('title') is-invalid @enderror">

	@error('title')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror

# 六、零散知识

## 1.注释
	{{-- 模板注释，但不显示在页面上 --}}

## 2.写原生PHP
	@php
	    //
	@endphp

# 七、组件

# 八、其他：堆栈、服务注入、Blade扩展