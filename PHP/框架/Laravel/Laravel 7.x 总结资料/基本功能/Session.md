---
# 目录
### 一、Session
### 二、驱动程序
### 三、使用Session：增删改查
---

# 一、Session

- 在多个请求之间存储有关用户信息。
- 配置文件：config/session.php。
- 默认驱动是file,使用 memcached 或 redis 驱动，可以让 Session 的性能更加出色。
- Session 驱动：file、cookie、database、memcache、redis、array（用于测试）。

# 二、驱动程序

## 1.数据库：需要使用迁移文件创建Session 表
    Schema::create('sessions', function ($table) {
        $table->string('id')->unique();
        $table->unsignedInteger('user_id')->nullable();
        $table->string('ip_address', 45)->nullable();
        $table->text('user_agent')->nullable();
        $table->text('payload');
        $table->integer('last_activity');
    });

## 2.Redis
- 需要通过 Composer 安装 predis/predis 扩展包 (~1.0)。
- 在 database 配置文件中配置 Redis 连接信息。
- 在 session 配置文件中，connection 选项可用于指定 Session 使用哪个 Redis 连接。

## 3.添加自定义驱动
- 如，MongoDB。
- 自定义的 Session 驱动必须实现 SessionHandlerInterface 接口。
- 当实现驱动后，需要在框架中注册它。
- 驱动完成注册时，你可以在使用在配置文件 config/session.php 中使用 mongo 驱动。



# 三、使用Session：增删改查

## 1.获取数据：session函数、Request实例

### ①Request实例
    public function show(Request $request, $id)
    {
        //获取一个值
        $value = $request->session()->get('key');
        
        //传递默认值
        $value = $request->session()->get('key', 'default');
        
        //闭包传递默认值
        $value = $request->session()->get('key', function () {
            return 'default';
        });
        
        //获取所有数据
        $data = $request->session()->all();

        //判断值是否存在
        if ($request->session()->has('users')) {}
        if ($request->session()->exists('users')) {}
    }

### ②session全局辅助函数
    // 获取 session 中的一条数据...
    $value = session('key');

    // 指定一个默认值...
    $value = session('key', 'default');

## 2.存储数据
    // 通过请求实例...
    $request->session()->put('key', 'value');

    //新增数据到Session数组
    $request->session()->push('user.teams', 'developers');

    // 通过全局辅助函数...
    session(['key' => 'value']);

## 2.1 闪存数据：一次性数据
    //仅用于下一次请求
    $request->session()->flash('status', 'Task was successful!');
    
    //应用于更多请求
    $request->session()->reflash();
    
    //保存
    $request->session()->keep(['username', 'email']);


## 3.删除数据
    //删除一条数据
    $value = $request->session()->pull('key', 'default');

    // 删除单个值...
    $request->session()->forget('key');

    // 删除多个值...
    $request->session()->forget(['key1', 'key2']);

    //删除所有数据
    $request->session()->flush();

## 4.重新生成Session ID
    $request->session()->regenerate();