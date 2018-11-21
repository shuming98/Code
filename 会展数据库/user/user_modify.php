<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../public.css">
	<title>网站管理系统</title>
	<style>
.form_account{
  width:  600px;
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
  margin-left: 80px;
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
<h2 class="title_h2">用户信息修改</h2>
<span class="title_span"></span>
<form class="form_account" id="form_verify" method="POST">
<p>姓名：<input class="form_input" type="text" name="name" value="<?php echo $arr['name']; ?>"></p>
  <p>性别：
    <input class="form_radio" type="radio" name="gender" value="男" required="required">男
    <input class="form_radio" type="radio" name="gender" value="女">女
  </p>
  <p>年龄：<input class="form_input" type="text" name="age" value="<?php echo $arr['age']; ?>"></p>
  <p>月收入：
    <input  class="form_radio" type="radio" name="income" value="0" required="required">无
    <input class="form_radio" type="radio" name="income" value="<5000">5000以下
    <input class="form_radio" type="radio" name="income" value="5000-10000">5000-10000
    <input class="form_radio" type="radio" name="income" value=">10000">10000以上
  </p>
  <p>意向：
    <input class="form_radio" type="radio" name="tend" value="零售类" required="required">零售类
    <input class="form_radio" type="radio" name="tend" value="娱乐类">娱乐类
    <input class="form_radio" type="radio" name="tend" value="生活类">生活类
    <input class="form_radio" type="radio" name="tend" value="餐饮类">餐饮类
    <input class="form_radio" type="radio" name="tend" value="健康类">健康类
  </p> 
  <p>手机号：<input class="form_input" type="text" name="mobile_number" value="<?php echo $arr['mobile_number']; ?>"></p>
  <p>邮箱：<input class="form_input" type="text" name="email" value="<?php echo $arr['email']; ?>"></p>
  <input class="form_button" type="submit" />
  <input class="form_button" type="reset" />
</form>
</div> 
<script>
  document.getElementById('form_verify').onsubmit=function(){
    var patt=/^1[3|4|5|7|8][0-9]{9}$/;
    if(!patt.test(document.getElementsByName('mobile_number')[0].value)){
      alert('请输入正确的手机号码');
      return false;
    }
    var patt=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(!patt.test(document.getElementsByName('email')[0].value)){
      alert('请输入正确的Email');
      return false;
    }
  }
</script> 
</body>
</html>