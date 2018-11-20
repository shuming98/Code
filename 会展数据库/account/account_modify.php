<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../public.css">
	<title>网站管理系统</title>
	<style>
.form_account{
  width:  380px;
  margin: 50px auto;
}
.form_account>p{
   font-size: 1.5em;
}
.form_input{
   width: 300px;
   padding: 5px 10px 5px;
   font-size: 1em;
   border: none;
   outline: none;
   border-bottom: 1px solid gray;
}
.form_button{
  font-size: 1em;
  width: 100px;
  margin-left: 60px;
}
</style>
</head>
<body>
  <div class="container">
	  <div class="navbar">
      <div id="t_nav">  
    <a href="#">首页</a>
    <div class="dropdown">
      <button class="dropbtn cursor">账号管理
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="./account_add.html">账号信息添加</a>
        <a href="./account_select.php">账号信息查询</a>
        <a href="./account_update.php">账号信息维护</a>
      </div>
    </div> 
    <div class="dropdown">
      <button class="dropbtn cursor">用户管理 
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="#">用户信息添加</a>
        <a href="#">用户信息查询</a>
        <a href="#">用户信息维护</a>
      </div>
    </div>  
    <div class="dropdown">
      <button class="dropbtn cursor">展商管理
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="#">展商信息添加</a>
        <a href="#">展商信息查询</a>
        <a href="#">展商信息维护</a>
      </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn cursor">观众管理
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">观众信息添加</a>
      <a href="#">观众信息查询</a>
      <a href="#">观众信息维护</a>  
    </div>
  </div> 
  <a href="#">关于</a>
  <a href="#">退出</a>
</div>  
</div>
<h2 class="title_h2">账号信息修改</h2>
<span class="title_span"></span>
<form class="form_account" method="POST">
  <p>账号：<input class="form_input" type="text" disabled="disabled" name="username" value="<?php echo $arr['username']; ?>"  ></p>
  <p>密码：<input class="form_input" type="password" name="password" value="<?php echo $arr['password']; ?>" ></p>
  <input class="form_button" type="submit" />
  <input class="form_button" type="reset" />
</form>
</div>  
</body>
</html>