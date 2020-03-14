<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//数据库操作学习
class DBController extends Controller
{
	//添加数据
    public function insert(){
    	//添加一条数据
    	//$data = ['title'=>'天气','content'=>'晴天','stu'=>'7'];
    	//添加多条数据
    	$data = array(
    		array('title'=>'天气','content'=>'晴天','stu'=>'1'),
    		array('title'=>'天气','content'=>'晴天','stu'=>'2'),
    		array('title'=>'天气','content'=>'晴天','stu'=>'3')
    	);
    	$res = DB::table('la_study')->insert($data);
    	dump($res);
    }

    //获取上一条添加数据的Id
	public function getId(){
		$data = ['title'=>'天气','content'=>'晴天','stu'=>'7'];
		$res = DB::table('la_study')->insertGetId($data);	
	 	dump($res);
	}

	//修改数据
    public function edit(){
    	//键值形式修改
    	// $res = DB::table('la_study')->where('id',1)->update(['title'=>'第一条']);
    	// 数值增加
    	$res = DB::table('la_study')->where('id',2)->increment('stu',4);
    	//数值减少
    	$res = DB::table('la_study')->where('id',3)->decrement('stu',2);
    	dump($res);
    }		

    //删除数据
	public function del(){
		//删除某一条
		$res = DB::table('la_study')->where('id',5)->delete();
		//删除某范围
		$res = DB::table('la_study')->where('id','>',5)->delete();
		//清表
		$res = DB::table('la_study')->truncate();
		dump($res);
	}

	//查询数据
	public function show(){ 
		//查询全部
		$res = DB::table('la_study')->get();
		//加限制条件
		$res = DB::table('la_study')->where('id','>',6)->get();
		//只看某列
		$res = DB::table('la_study')->select('title')->where('id','>',6)->get();
		//只取一条数据
		$res = DB::table('la_study')->select('title')->where('id','>',6)->first();
		//只取列的单个值
		$res = DB::table('la_study')->where('stu','>',1)->value('stu');
		//只取某列全部值
		$res = DB::table('la_study')->pluck('content');	
		//使用原生
		$res = DB::select('select * from la_study');
		foreach($res as $v){
			echo $v->title,'~';//输出二维数组值$res[0][title]改为$res[0]->title
		}

		dump($res); 
	}

}
