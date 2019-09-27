<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');	
});


//基础路由
Route::get('user',function(){
	return 'user_get';	
});

Route::post('user',function(){
	return 'user_post';
});
//定义了同一路由两次，以最后一次为准

//多请求路由
Route::match(['get','post'],'user/re',function(){
	return 'user_get || post';
});

//任意次请求
Route::any('user/any',function(){
	return 'user_any';
});

//_______________路由限制___________________
//路由传参一个或多个
Route::get('user/{id}/{name}',function($id,$name){
	return '路由传参+接收'.$id.'--'.$name;
});

//路由传可选参数，如分页，第一页无参，其他页有参
Route::get('page/{id?}',function($id=1){
	return 'page_'.$id;
});

//路由限制传参的内容(类型)
Route::get('reg/{id}',function($id){
	dump('reg_'.$id);
})->where('id','\d+'); //只可以传参数字

Route::get('reg/{id}/{name}',function($id,$name){
	dump('reg_'.$id.'_'.$name);
})->where(['id'=>'\d+','name'=>'[a-zA-Z]+']); //多个传参，写数组

//____________________学习________________________
Route::get('user/show','UserController@show');
Route::get('admin/user/index','Admin\UserController@index');

//数据库操作
Route::get('db/insert','DBController@insert');
Route::get('db/edit','DBController@edit');
Route::get('db/show','DBController@show');
Route::get('db/del','DBController@del');
Route::get('db/getid','DBController@getId');

//留言板路由
Route::get('msg/index','MsgController@index');
Route::get('msg/add','MsgController@add');
Route::post('msg/add','MsgController@addPost');
Route::match(['get','post'],'msg/edit/{id}','MsgController@edit');
Route::get('msg/del/{id}','MsgController@del');

//Blade模板
Route::get('msg/show','MsgController@show');
//视图路由（仅展示页面，不需要后台传参）[URL,视图名称,传参数组]
Route::view('/','welcome',['name'=>'Hackintosh']);
Route::get('msg/req','MsgController@req');

