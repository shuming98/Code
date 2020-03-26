<?php
九、定时任务(artisan + crontab)
A.自定义artisan命令
	①php artisan make:command Grow
	②位置：App\Console\Commands\Grow.php

		class Grow extends Command
		{
			//命令名称
		    protected $signature = 'grow';
		    //命令描述
		    protected $description = 'Create a time task to finish pay';
		    //命令执行代码
		    public function handle()
		    {
		        $today = date('Ymd',time());
		        $tasks = DB::table('tasks')->where('enddate','>=',$today)->get();
		        foreach($tasks as $t){
		            $t = (array)$t;
		            $t['paytime'] = $today;
		            unset($t['tid']);
		            unset($t['enddate']);
		            DB::table('grows')->insert($t);
		        }
		    }
		}

	或③位置：/routes/console.php

Artisan::command('命令名称', function () {
    执行代码
})->describe('命令描述');

④查看命令:php artisan list

B.定时任务
	sudo crontab -e
	* * * * * (iHdmN) php /Path/app/artisan grow
?>