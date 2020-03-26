---
# 目录
### 一、URL
### 二、生成URL
### 三、签名URL
### 四、默认值
---


# 一、URL

- 用于在模板和 API 响应中构建 URL 。
- 生成重定向响应。

# 二、生成URL

## 1.生成URL
	$post = App\Post::find(1);
	echo url("/posts/{$post->id}");

	// http://example.com/posts/1

## 2.访问当前URL：use Illuminate\Support\Facades\URL;
	// 给出当前URL，不带参数
	echo url()->current();
	echo URL::current();

	// 给出当前URL，带参数
	echo url()->full();

	// 给出上一个完整请求URL
	echo url()->previous();

## 3.命名路由的URL
	echo route('post.show', ['post' => 1]);

## 4.控制器行为的URL
	$url = action('HomeController@index');
	$url = action([HomeController::class, 'index']);
	$url = action('HomeController@index', ['id' => 1]);

# 三、签名URL：防修改	

# 四、默认值：指定URL参数的默认值