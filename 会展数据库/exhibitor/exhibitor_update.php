<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/public.css">
  <title>网站管理系统</title>
  <style>
.div_table{
  height: 495px;
  margin-top: 20px;
  margin-left: 100px;
  overflow:auto;
}
.form_update{
  margin-top: 20px;
  margin-left: 100px;
}
.form_checkbox{
  font-size: 1.2em;
}
.form_button{
  padding: 1px 5px;
  font-size: 18px;  
  cursor: pointer;
  color: #fff;
  background-color: #3198D5;
  border: none;
  border-radius: 5px;
  box-shadow: 0 1px #999; 
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
      <a href="../message/message_add.html">留言信息添加</a>
      <a href="../message/message_select.php">留言信息查询</a>
      <a href="../message/message_update.php">留言信息维护</a>
    </div>
  </div> 
  <a href="../other/about_us.html">关于</a>
  <a href="../index.php">退出</a>
</div>  
</div>
<h2 class="title_h2">展商信息维护</h2>    
<span class="title_span"></span>

<form class="form_update" action="./exhibitor_update.php" method="get">
  <input class="form_checkbox" type="checkbox" name="username" checked="checked">联系人
  <input class="form_checkbox" type="checkbox" name="enterprise" checked="checked">企业品牌
  <input class="form_checkbox" type="checkbox" name="address">品牌发源地
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
      error_reporting(0);
      if($_GET['username']=='on'){
        echo '<td>联系人</td>';
      }
      if($_GET['enterprise']=='on'){
        echo '<td>企业品牌</td>';
      }
      if($_GET['address']=='on'){
        echo '<td>品牌发源地</td>';
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
  include ('../conn.php');
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