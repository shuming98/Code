<?php
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
?>