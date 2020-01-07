<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
    	$arr = array('name','people','apple');
    	dump($arr);
    	$data = ['id'=>'3','name'=>'wsm'];
    	//return view('show',$data);
    	//return view('show',['data'=>$data]);
    	//return view('show',compact('data'));
    	return view('article.index');

    }
}
