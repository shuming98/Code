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
  margin-left: 100px;
  overflow:scroll;
}
.form_update{
  margin-left: 100px;
}
.form_checkbox{
  font-size: 1.2em;
}
.form_button{
  -webkit-appearance: button;
  font-size: 16px;
  border-radius: 7px;
  background: #f8f8f8;  
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

<form class="form_update" action="./exhibitor_update.php" method="get">
  <input class="form_checkbox" type="checkbox" name="username" checked="checked">联系人
  <input class="form_checkbox" type="checkbox" name="enterprise" checked="checked">企业名称
  <input class="form_checkbox" type="checkbox" name="address">联系地址
  <input class="form_checkbox" type="checkbox" name="tel">联系号码
  <input class="form_checkbox" type="checkbox" name="email">邮箱
  <input class="form_checkbox" type="checkbox" name="application" checked="checked">展区申请
  <input class="form_checkbox" type="checkbox" name="type" checked="checked">展台类型
  <input class="form_checkbox" type="checkbox" name="number" checked="checked">申请数量
  <input class="form_button" type="submit" value="筛选">
</form>

<div class="div_table">
  <table>
    <tr>
      <?php 
      if($_GET['username']=='on'){
        echo '<td>联系人</td>';
      }
      if($_GET['enterprise']=='on'){
        echo '<td>企业名称</td>';
      }
      if($_GET['address']=='on'){
        echo '<td>联系地址</td>';
      }
      if($_GET['tel']=='on'){
        echo '<td>联系号码</td>';
      }
      if($_GET['email']=='on'){
        echo '<td>邮箱</td>';
      }
      if($_GET['application']=='on'){
        echo '<td>展区申请</td>';
      }
      if($_GET['type']=='on'){
        echo '<td>展台类型</td>';
      }
      if($_GET['number']=='on'){
        echo '<td>申请数量</td>';
      }
      if(($_GET['username']=='on') || ($_GET['enterprise']=='on') || ($_GET['address']=='on') || ($_GET['tel']=='on') || ($_GET['email']=='on') || ($_GET['application']=='on') || ($_GET['type']=='on') || ($_GET['number']=='on')){
     echo '<td colspan="2">数据维护操作</td>'; 
    }
      ?>
    </tr>

    <?php 
  //error_reporting(0);
  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');   
  $data=mysqli_query($conn,'select * from exhibitor');
  while($row=mysqli_fetch_assoc($data)){
   ?>
    <tr>
      <?php  
      if($_GET['username']=='on'){
        echo '<td>',$row['username'],'</td>';
      }
      if($_GET['enterprise']=='on'){
        echo '<td>',$row['enterprise'],'</td>';
      }
      if($_GET['address']=='on'){
        echo '<td>',$row['address'],'</td>';
      }
      if($_GET['tel']=='on'){
        echo '<td>',$row['tel'],'</td>';
      }
      if($_GET['email']=='on'){
        echo '<td>',$row['email'],'</td>';
      }
      if($_GET['application']=='on'){
        echo '<td>',$row['application'],'</td>';
      }
      if($_GET['type']=='on'){
        echo '<td>',$row['type'],'</td>';
      }
      if($_GET['number']=='on'){
        echo '<td>',$row['number'],'</td>';
      }
      if(($_GET['username']=='on') || ($_GET['enterprise']=='on') || ($_GET['address']=='on') || ($_GET['tel']=='on') || ($_GET['email']=='on') || ($_GET['application']=='on') || ($_GET['type']=='on') || ($_GET['number']=='on')){
      echo '<td><a href="./mysql_update.php?id=',$row['id'],'">修改</a></td>';
      echo '<td><a href="./mysql_delete.php?id=',$row['id'],'">删除</a></td>';
    }
      ?>
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