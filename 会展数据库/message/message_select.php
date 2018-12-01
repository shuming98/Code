<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/public.css">
  <title>网站管理系统</title>
  <style>
.div_multiform{
  margin: 20px 0px 70px 100px;
}
.form_select{
  display: block;
  float: left;
  margin: 0px 70px 0px 0px; 
}
.form_select span{
  font-size: 20px;
}
.form_username{
  width: 230px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_enterprise{
  width: 300px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_email{
  width: 250px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_button{
  -webkit-appearance: button;
  font-size: 18px;
  border-radius: 7px;
  background: #f8f8f8;
}
.div_table{
  width: 100%;
  float: left;
  height: 497px;
  margin-left:100px;
  overflow:scroll;
}
table{
  border-collapse: collapse;
}
td{
  padding: 3px 20px 0px;
  font-size: 1.2em;
  text-align: center;
  border: 1px dashed #3198D5;
  white-space:nowrap;
}
</style>
</head>
<body>
  <div class="container">
    <div class="navbar">
      <div id="t_nav">  
    <a href="../home/home.html">首页</a>
    <div class="dropdown">
      <button class="dropbtn cursor">账号管理
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="../account/account_add.html">账号信息添加</a>
        <a href="../account/account_select.php">账号信息查询</a>
        <a href="../account/account_update.php">账号信息维护</a>
      </div>
    </div> 
    <div class="dropdown">
      <button class="dropbtn cursor">用户管理 
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="../user/user_add.html">用户信息添加</a>
        <a href="../user/user_select.php">用户信息查询</a>
        <a href="../user/user_update.php">用户信息维护</a>
      </div>
    </div> 
    <div class="dropdown">
      <button class="dropbtn cursor">展商管理
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="../exhibitor/exhibitor_add.html">展商信息添加</a>
        <a href="../exhibitor/exhibitor_select.php">展商信息查询</a>
        <a href="../exhibitor/exhibitor_update.php">展商信息维护</a>
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
  <a href="../other/about_us.html">关于</a>
  <a href="../index.php">退出</a>
</div>  
</div>
<h2 class="title_h2">留言信息查询</h2>
<span class="title_span"></span>
<div class="div_multiform">
<form class="form_select" action="./message_select.php?username=" method="get">
  <span>联系人：
  <input name="username" class="form_username" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./message_select.php?enterprise=" method="get">
  <span>企业名称：
  <input name="enterprise" class="form_enterprise" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<br/><br/>
<form class="form_select" action="./message_select.php?email=" method="get">
  <span>邮箱： 
  <input name="email" class="form_email" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
</form>
</div>  
<div class="div_table">
  <table>
    <tr>
      <td>id</td>
      <td>联系人</td>     
      <td>企业名称</td>
      <td>邮箱</td>
      <td>留言信息</td>     
      <td colspan="2">数据维护操作</td>
    </tr>
    <?php
  error_reporting(0);
  $username=$_GET['username'];
  $enterprise=$_GET['enterprise'];
  $email=$_GET['email'];

  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');

  $sql="select * from message where username = '$username'";
  $sql2="select * from message where enterprise = '$enterprise'";
  $sql3="select * from message where email = '$email'";

  $data=mysqli_query($conn,$sql); 
  $data2=mysqli_query($conn,$sql2); 
  $data3=mysqli_query($conn,$sql3);

  if(mysqli_num_rows($data)){
    $data=$data;
  }else if (mysqli_num_rows($data2)){
    $data=$data2;
  }else{
    $data=$data3;
  }

  while($row=mysqli_fetch_assoc($data)){
   ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['enterprise']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['message'],'<br/>'; ?></td>
      <td><a href="./mysql_update.php?id=<?php echo $row['id']; ?>">修改</a></td>
      <td><a href="./mysql_delete.php?id=<?php echo $row['id']; ?>">删除</a></td>
    </tr>
  <?php }
    ?>  
  </table>
  <?php 
  if(($username!==NULL || $enterprise!==NULL || $email!==NULL)&&($data->num_rows)==0){
    echo '<h2>没有该查询结果！！！</h2>';
  } 
   mysqli_close($conn);
  ?>
</div>
</div>
</body>
</html>