<?php
三、数据库事务(一表提交多表同步)
0.引入相关Model和类：use App\Model;use DB;use Auth;
1.Model.php：
	//允许添加的字段
	protected $fillable = ['field','field'...];
2.添加——相应代码：
	//登录后获取用户的信息
	$user = Auth::user();
	//$user = request()->user();
	
	//开启事务
	DB::beginTransaction();

	//执行并异常处理
	try{ //一个表一个try..catch..
		$pro = Pro::create([  //Pro是Model
			//字段插入的内容
			'uid'=>$user->uid,
			'money'=>request('money')*100,
			'mobile'=>request('mobile'),
			'pubtime'=>time()
		]);
	}catch(\Exception $e)
	{
		//报错回滚
		DB::rollback();
		throw $e;
	}

	try{ //副表
	$att = Atts::create([
		'pid'=>$pro->pid,
		'uid'=>$user->uid,
		'age'=>request('age')
	]);
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}

	//提交事务
	DB::commit();
	return 'Success';

3.修改——相应代码
	$pro = Pro::find($pid);
	$att = Atts::where('pid',$pid)->first(); //先查

	DB::begintransaction();

	try{
		$pro->title = request('title'); //再修改
		$pro->save();
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}


	try{
		$att->title = request('title');
		$att->save();
	}catch(\Exception $e)
	{
		DB::rollback();
		throw $e;
	}

	DB::commit();
	return redirect('prolist');
?>