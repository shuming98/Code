<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../public.css">
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
.form_input{
  width: 200px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_name{
  width: 170px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_enterprise{
  width: 535px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_tel{
  width: 150px;   
  border: none; 
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_email{
  width: 575px; 
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_option{
  font-size: 18px;
  width: 150px;
}
.form_button{
  -webkit-appearance: button;
  font-size: 18px;
  border-radius: 7px;
  background: #f8f8f8;
}
.div_table{
  height: 497px;
  width: 1200px;
  margin: 20px auto 50px;
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
        <a href="./exhibitor_select.php">用户信息查询</a>
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
<h2 class="title_h2">展商信息查询</h2>
<span class="title_span"></span>

<div class="div_multiform">
<form class="form_select" action="./exhibitor_select.php?username=" method="get">
  <span>联系人：
  <input name="username" class="form_name" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./exhibitor_select.php?enterprise=" method="get">
  <span>企业名称：
  <input name="enterprise" class="form_enterprise" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<br/><br/>
<form class="form_select" action="./exhibitor_select.php?tel=" method="get">
  <span>联系号码：
  <input name="tel" class="form_tel" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./exhibitor_select.php?email=" method="get">
  <span>邮箱：
  <input name="email" class="form_email" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<br/><br/>
<form class="form_select" action="./exhibitor_select.php?application=" method="get">
  <span>展区申请：
  <select class="form_option" name="application" id="application">
    <option value="零售类">零售类</option>
    <option value="娱乐类">娱乐类</option>
    <option value="生活类">生活类</option> 
    <option value="餐饮类">餐饮类</option>
    <option value="健康类">健康类</option>
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./exhibitor_select.php?type=" method="get">
  <span>展台类型：
  <select class="form_option" name="type" id="type">
    <option value="标准展台单开">标准展台单开</option>
    <option value="标准展台双开">标准展台双开</option> 
    <option value="豪华展台单开">豪华展台单开</option> 
    <option value="豪华展台双开">豪华展台双开</option> 
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./exhibitor_select.php?number=" method="get">
  <span>申请数量：
  <select class="form_option" name="number" id="number">
    <option value="1">1个</option>
    <option value="2">2个</option> 
    <option value="3">3个</option>
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
</div>  
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

  $username=$_GET['username'];
  $enterprise=$_GET['enterprise'];
  $tel=$_GET['tel'];
  $email=$_GET['email'];
  $application=$_GET['application'];
  $type=$_GET['type'];
  $number=$_GET['number'];    

  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');

  $sql="select * from exhibitor where username = '$username'";
  $sql2="select * from exhibitor where enterprise = '$enterprise'";
  $sql3="select * from exhibitor where tel = '$tel'";
  $sql4="select * from exhibitor where email = '$email'";
  $sql5="select * from exhibitor where application = '$application'";
  $sql6="select * from exhibitor where type = '$type'";
  $sql7="select * from exhibitor where number = '$number'";

  $data=mysqli_query($conn,$sql); 
  $data2=mysqli_query($conn,$sql2); 
  $data3=mysqli_query($conn,$sql3);
  $data4=mysqli_query($conn,$sql4); 
  $data5=mysqli_query($conn,$sql5); 
  $data6=mysqli_query($conn,$sql6); 
  $data7=mysqli_query($conn,$sql7); 

  if(mysqli_num_rows($data)){
    $data=$data;
  }else if (mysqli_num_rows($data2)){
    $data=$data2;
  }else if (mysqli_num_rows($data3)){
    $data=$data3;
  }else if (mysqli_num_rows($data4)){
    $data=$data4;
  }else if (mysqli_num_rows($data5)){
    $data=$data5;
  }else if (mysqli_num_rows($data6)){
    $data=$data6;
  }else{
    $data=$data7;
  }

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
  <?php }
    ?>
  </table>
  <?php 
  if(($username!==NULL || $enterprise!==NULL || $tel!==NULL || $email!==NULL || $application!==NULL || $type!==NULL || $number!==NULL)&&($data->num_rows)==0){
    echo '<h2>没有该查询结果！！！</h2>';
  } 
   mysqli_close($conn);
  ?>
</div>
</div>
</body>
</html>