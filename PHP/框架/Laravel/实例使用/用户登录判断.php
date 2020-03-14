<?php 
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
 ?>