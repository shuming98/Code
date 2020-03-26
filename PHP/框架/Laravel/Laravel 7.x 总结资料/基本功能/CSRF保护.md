---
目录
### 一、CSRF保护：跨站请求伪造攻击
### 二、CSRF令牌
### 三、表单方法伪造：让HTML表单支持PUT/DELETE/PATCH行为
---

# 一、CSRF保护：跨站请求伪造攻击

- 凭借已通过身份验证的用户身份来运行未经过授权的命令。
- Laravel 会生成一个 CSRF「令牌」，用于验证用户是否是向应用程序发出请求的用户。
- 任何HTML表单都要包含一个隐藏的CSRF标记字段。

# 二、CSRF令牌

## 1.POST方式的HTML表单需要包含一个CSRF令牌字段，否则，拒绝请求。
    <form method="POST">
        @csrf
        .......
    </form>

## 2.X-CSRF-TOKEN 请求头
    <meta name="csrf-token" content="{{ csrf_token() }}">

## 3.CSRF白名单：App/Http/Middleware/VerifyCsrfToken
    protected $except = [
        'touzi/*'
        '$uri'
    ];



# 三、表单方法伪造：让HTML表单支持PUT/DELETE/PATCH行为。
    <form action="/url" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>

或

    <form action="/url" method="POST">
        @method('PUT');
        @csrf
    </form>

