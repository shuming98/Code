<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/public.css">
  <title>网站管理系统</title>
  <style>
.div_table{
  height: 521px;
  margin-top: 20px;
  margin-left: 100px;
  overflow:auto;  
}
table{
  border-collapse: collapse;
}
td{
  padding: 3px 15px 0px;
  font-size: 18px;
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
<h2 class="title_h2">留言信息维护</h2>
<span class="title_span"></span>
<div class="div_table">
  <table>
    <tr>
      <td>id</td>
      <td>联系人</td>     
      <td>企业品牌</td>
      <td>邮箱</td> 
      <td>留言信息</td>
      <td colspan="2">数据维护操作</td> 
    </tr>
    <?php 
  error_reporting(0);
  include ('../conn.php');

  $data=mysqli_query($conn,'select * from message order by id');
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
    <?php 
    }
   mysqli_close($conn);
    ?>
  </table>
</div>
</div> 
</body>
</html>