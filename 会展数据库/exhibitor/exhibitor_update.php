<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../public.css">
  <title>网站管理系统</title>
  <style>
.div_table{
  height: 559px;
  margin-top: 20px;
  overflow:scroll;
}
table{
  border-collapse: collapse;
}
td{
  padding: 3px 20px 0px;
  font-size: 1em;
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
      <a href="#">留言信息添加</a>
      <a href="#">留言信息查询</a>
      <a href="#">留言信息维护</a>
    </div>
  </div> 
  <a href="#">关于</a>
  <a href="#">退出</a>
</div>
</div>
<h2 class="title_h2">展商信息维护</h2>
<span class="title_span"></span>
<div class="div_table">
  <table>
    <tr>
      <td>联系人</td>
      <td>企业名称</td>     
      <td>联系地址</td>
      <td>联系号码</td>
      <td>邮箱</td>     
      <td>展区申请</td>
      <td>展台类型</td>
      <td>申请数量</td>
      <td colspan="2">数据维护操作</td> 
    </tr>
    <?php 
  error_reporting(0);
  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');   
  $data=mysqli_query($conn,'select * from exhibitor');
  while($row=mysqli_fetch_assoc($data)){
   ?>
    <tr>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['enterprise']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['tel']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['application']; ?></td>
      <td><?php echo $row['type']; ?></td>
      <td><?php echo $row['number'],'<br/>'; ?></td>
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