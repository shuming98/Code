<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Msg;
class MsgController extends Controller
{
    public function index(){
    	//$msg = DB::table('msgs')->orderBy('id','desc')->get();
    	
    	//Model 操作
    	
    	//查单行(根据主键id)
    	//$msg = Msg::where('id',1)->first();
    	//$msg = Msg::find(1);
    	
    	//查多行
    	//$msg = Msg::where('id','>',1)->get(['title']); //get(['选择某一列'])
    	//$msg = Msg::select('title')->get();

    	//全取出来
    	//$msg = Msg::all(); //all()可选择列
    	
    	//$msg = Msg::where('id','>=',1)->skip(2)->take(1)->get();
    	$msg = Msg::orderBy('id','desc')->get();
    	//dump($msg);
    	return view('msg.index',compact('msg'));
    } 

    public function add(){
    	return view('msg.add');
    }

    public function addPost(Request $req){
    	if($_POST['title'] == '' && $_POST['content'] == ''){
    		return back(); //为空，返回上一页
    	}else{
    		//$data = ['title'=>$_POST['title'],'content'=>$_POST['content']];
    		//$data = array('title'=>$_POST['title'],'content'=>$_POST['content']);
    		//$res = DB::table('msgs')->insert($data);
    		
    		// Model操作
    		$msg = new \App\Msg();
    		$msg->title = $_POST['title'];
    		$msg->content = $_POST['content'];
    		
    		//文件上传
    		//$req->file('pic')->move('/Users/shuming/www/php/Laravel/laravel','a.png');
    		//$path = $req->file('pic')->store('upload');
    		$path = $req->file('pic')->storeAs('public','name.png');
    		//$path = Storage::putFile('upload',$req->file('pic'));
    		//$path = Storage::putFileAs('upload',$req->file('pic'),'name.png');
    		return asset('storage/'.$path);
    		//$res = $msg->save();

    		return $res?dump('添加成功'):back();
    	}
    }

    public function edit(Request $req,$id){
    	if(empty($_POST)){
    		//$msg = DB::table('msgs')->where('id',$id)->first();
    		
    		$msg = Msg::where('id',$id)->first();
    		return view('msg.edit',compact('msg'));
    	}else{
    		// $data = ['title'=>$_POST['title'],'content'=>$_POST['content']];
    		// $res = DB::table('msgs')->where('id',$id)->update($data);
    			
    		$msg = Msg::find($id);
    		// $msg->title = $_POST['title'];
    		// $msg->content = $_POST['content'];
    		
    		// request对象当POST使用
    		$msg->title = $req->title;
    		//字段注入.form表单没有此数据，可以用注入方式写进数据库
    		//$msg->title = $req->input('title','注入');
    		$msg->content = $req->content;
    		$res = $msg->save();

    		return $res?redirect('msg/index'):back();
    	}
    }

    public function del($id){
    	//$res = DB::table('msgs')->where('id',$id)->delete();
    	$res = Msg::where('id',$id)->delete();
    	return $res?redirect('msg/index'):back();
    }

    public function show(){
    	//Blade赋值,及传多个变量
    	//一维数组
    	$var = 3;
    	$data = ['title'=>'Laravel'];
    	//return view('msg.show',$data); 
    	//--res--->>{{$title}}
    	//return view('msg.show',compact('data','var'));
    	//return view('msg.show')->with('data',$data)->with('var',$var);
    	//return view('msg.show',['data'=>$data,'var'=>$var]);
    	//---res-->>{{$data['title']}}
    	
    	//二维数组
    	$data2 = ['title'=>'Laravel2','score'=>mt_rand(10,99),'id'=>mt_rand(1,5)];
    	$num = ['one','two','three'];
    	//return view('msg.show',compact('data2','num'));
    	// 模板继承
    	return view('blade.son');
    }

    //Request 对象
    public function req(Request $req){
    	dump($req);
    }
} 
