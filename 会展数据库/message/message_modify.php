<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../public.css">
	<title>网站管理系统</title>
	<style>
#div_form{
  height: 580px;
}
.form_account{
  width:  560px;
  margin: 20px auto;
}
.form_account>p{
   font-size: 1.2em;
}
.form_input{
   width: 400px;
   padding: 5px 10px 5px;
   font-size: 1.2em;
   border: none;
   outline: none;
   border-bottom: 1px solid gray;
}
.input_id{width: 440px;}
.input_username{width: 405px;}
.input_enterprise{width: 390px;}
.input_email{width: 420px;}
.message{
  font-size: 1em;
}
.form_button{
  font-size: 1em;
  width: 100px;
  margin:10px 0px 0px 80px;

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
        <a href="./user_add.html">用户信息添加</a>
        <a href="./user_select.php">用户信息查询</a>
        <a href="./user_update.php">用户信息维护</a>
      </div>
    </div> 
    <div class="dropdown">
      <button class="dropbtn cursor">展商管理
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="./exhibitor_add.html">展商信息添加</a>
        <a href="./exhibitor_select.php">展商信息查询</a>
        <a href="./exhibitor_update.php">展商信息维护</a>
      </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn cursor">留言管理
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="./message_add.html">留言信息添加</a>
      <a href="./message_select.php">留言信息查询</a>
      <a href="./message_update.php">留言信息维护</a>
    </div>
  </div> 
  <a href="#">关于</a>
  <a href="#">退出</a>
</div>    
</div>
<h2 class="title_h2">留言信息修改</h2>
<span class="title_span"></span>
<div id="div_form">
<form class="form_account" method="post">
  <p>id：<input class="form_input input_id" type="text" name="id" value="<?php echo $arr['id']; ?>" disabled="disabled"></p>
  <p>联系人：<input class="form_input input_username" type="text" name="username" value="<?php echo $arr['username']; ?>" disabled="disabled"></p>
  <p>企业名称：<input class="form_input input_enterprise" type="text" name="enterprise" value="<?php echo $arr['enterprise']; ?>" disabled="disabled"></p>
  <p>邮箱：<input class="form_input input_email" type="text" name="email" value="<?php echo $arr['email']; ?>" disabled="disabled"></p>
  <p>留言：</p><textarea class="message" name="message" cols="50" rows="10" placeholder="可填写会展及展会相关问题或您的个人情况，届时会有工作人员反馈咨询到您的邮箱。"><?php echo $arr['message']; ?></textarea>
  <input class="form_button" type="submit" />
  <input class="form_button" type="reset" />
</form>           
</div>  
</div>  
</body>
</html>