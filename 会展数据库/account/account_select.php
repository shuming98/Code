<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/public.css">
  <title>网站管理系统</title>
  <style>
.div_multiform{
  margin: 20px 0px 70px 200px;
}
.form_select{
  display: block;
  float: left;
  margin: 0px  100px 0px 0px; 
}
.form_select span{
  font-size: 20px;
}
.form_input{
  width: 200px;
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
  margin-left:200px;
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
      <a href="../message/message_add.html">留言信息添加</a>
      <a href="../message/message_select.php">留言信息查询</a>
      <a href="../message/message_update.php">留言信息维护</a>
    </div>
  </div> 
  <a href="../other/about_us.html">关于</a>
  <a href="../index.php">退出</a>
</div>  
</div>
<h2 class="title_h2">账号信息查询</h2>
<span class="title_span"></span>

<div class="div_multiform">
<form class="form_select" action="./account_select.php?id=" method="get">
  <span>id：<input name="id" class="form_input" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./account_select.php?username=" method="get">
  <span>账号：<input name="username" class="form_input" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
</div>  
<div class="div_table">
  <table>
    <tr>
      <td>id</td>
      <td>账号</td>     
      <td>密码</td>
      <td>最后修改时间</td>
      <td colspan="2">数据维护操作</td>
    </tr>
    <?php
  error_reporting(0);
  
  $id=$_GET['id'];    
  $username=$_GET['username'];

  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');
  
  $sql="select * from account where id = '$id'";
  $sql2="select * from account where username = '$username'";

  $data=mysqli_query($conn,$sql);
  $data2=mysqli_query($conn,$sql2);

  if(mysqli_num_rows($data)){ 
    $data=$data;
  }else{
    $data=$data2;
  }

  while($row=mysqli_fetch_assoc($data)){
   ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td><?php echo $row['time'],'<br/>'; ?></td>
      <td><a href="./mysql_update.php?id=<?php echo $row['id']; ?>">修改</a></td>
      <td><a href="./mysql_delete.php?id=<?php echo $row['id']; ?>">删除</a></td>
    </tr>
  <?php }
    ?>
  </table>
  <?php 
  if(($username!==NULL || $id!==NULL)&&($data->num_rows)==0){
    echo '<h2>没有该查询结果！！！</h2>';
  } 
   mysqli_close($conn);
  ?>
</div>
</div>
</body>
</html>