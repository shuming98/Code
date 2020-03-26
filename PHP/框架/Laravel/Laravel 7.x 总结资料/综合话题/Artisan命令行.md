---
# 目录
### 一、Artisan
### 二、Tinker命令：交互式的编程环境
### 三、编写命令——自定义
### 四、定义输入期望——输入参数和选项
### 五、命令 I/O——接收到的参数和选项的值
### 六、注册命令、以编程方式执行命令、Stub 定制
---

# 一、Artisan

- Laravel 自带的命令行接口。
- 提供了相当多的命令来帮助你构建 Laravel 应用。
- 你可以通过 list 命令查看所有可用的 Artisan 命令：php artisan list 。
- 每个命令都包含了「帮助」界面，只需要在命令前加上 help 即可：php artisan help [migrate] 。

# 二、Tinker命令：交互式的编程环境

## 1.安装
	composer require laravel/tinker

## 2.用法
	php artisan tinker

## 3.配置文件
	php artisan vendor:publish --provider="Laravel\Tinker\TinkerServiceProvider"

## 4.命令白名单
	'commands' => [
    	// App\Console\Commands\ExampleCommand::class,
	],

## 5.黑名单别名
	'dont_alias' => [
		//config/tinker.php
	    App\User::class,
	],

# 三、编写命令——自定义

## 1.生成命令
	php artisan make:command SendEmails
make:command 命令会在 app/Console/Commands 目录中创建一个新的命令类。  

## 2.命令结构
	//命令名称
	protected $signature = 'grow';

	//命令描述
	protected $description = 'Create a time task to finish pay';

	//命令执行代码
	public function handle()
	{
	   
	}

## 3.闭包命令

# 四、定义输入期望——输入参数和选项

# 五、命令 I/O——接收到的参数和选项的值

# 六、注册命令、以编程方式执行命令、Stub 定制