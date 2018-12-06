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
.form_input{
  width: 200px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_name{
  width: 130px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_age{
  width: 150px;
  border: none;
  outline: none;
  border-bottom: 1px solid gray;
  font-size: 20px;
}
.form_option{
  font-size: 18px;
  width: 130px;
  height: 25px;
  border-radius: 5px;
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
.div_table{
  width: 100%;
  float: left;
  height: 497px;
  margin-left:100px;
  overflow:auto;
}
table{
  border-collapse: collapse;
}
td{
  padding: 3px 20px 0px;
  font-size: 18px;
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
<h2 class="title_h2">用户信息查询</h2>
<span class="title_span"></span>

<div class="div_multiform">
<form class="form_select" action="./user_select.php?name=" method="get">
  <span>姓名：
  <input name="name" class="form_name" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./user_select.php?age=" method="get">
  <span>年龄：
  <input name="age" class="form_age" type="text"></span>
  <input class="form_button" type="submit" value="查询">
</form>
<br/><br/>
<form class="form_select" action="./user_select.php?gender=" method="get">
  <span>性别：
  <select class="form_option" name="gender" id="gender">
    <option value="男">男</option>
    <option value="女">女</option> 
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./user_select.php?in2come=" method="get">
  <span>月收入：
  <select class="form_option" name="income" id="income">
    <option value="0">0</option>
    <option value="<5000">&lt;5000</option> 
    <option value="5000-10000">5000-10000</option> 
    <option value=">10000">&gt;10000</option> 
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
<form class="form_select" action="./user_select.php?tend=" method="get">
  <span>参展意向：
  <select class="form_option" name="tend" id="tend">
    <option value="零售类">零售类</option>
    <option value="娱乐类">娱乐类</option> 
    <option value="生活类">生活类</option>
    <option value="餐饮类">餐饮类</option> 
    <option value="健康类">健康类</option>
  </select>
  </span>
  <input class="form_button" type="submit" value="查询">
</form>
</div>  
<div class="div_table">
  <table>
    <tr>
      <td>姓名</td>
      <td>性别</td>     
      <td>年龄</td>
      <td>月收入</td>
      <td>参展意向</td>     
      <td>手机号</td>
      <td>邮箱</td>
      <td colspan="2">数据维护操作</td>
    </tr>
    <?php
  error_reporting(0);

  $name=$_GET['name'];
  $age=$_GET['age'];
  $gender=$_GET['gender'];
  $income=$_GET['income'];
  $tend=$_GET['tend'];

  $conn=mysqli_connect('127.0.0.1','root','123456','uee'); 
  mysqli_query($conn,'set names utf8');

  $sql="select * from user where name = '$name'";
  $sql2="select * from user where age = '$age'";
  $sql3="select * from user where gender = '$gender'";
  $sql4="select * from user where income = '$income'";
  $sql5="select * from user where tend = '$tend'";

  $data=mysqli_query($conn,$sql); 
  $data2=mysqli_query($conn,$sql2); 
  $data3=mysqli_query($conn,$sql3);
  $data4=mysqli_query($conn,$sql4); 
  $data5=mysqli_query($conn,$sql5); 

  if(mysqli_num_rows($data)){
    $data=$data;
  }else if (mysqli_num_rows($data2)){
    $data=$data2;
  }else if (mysqli_num_rows($data3)){
    $data=$data3;
  }else if (mysqli_num_rows($data4)){
    $data=$data4;
  }else{
    $data=$data5;
  }

  while($row=mysqli_fetch_assoc($data)){
   ?>
    <tr>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['gender']; ?></td>
      <td><?php echo $row['age']; ?></td>
      <td><?php echo $row['income']; ?></td>
      <td><?php echo $row['tend']; ?></td>
      <td><?php echo $row['mobile_number']; ?></td>
      <td><?php echo $row['email'],'<br/>'; ?></td>
      <td><a href="./mysql_update.php?id=<?php echo $row['id']; ?>">修改</a></td>
      <td><a href="./mysql_delete.php?id=<?php echo $row['id']; ?>">删除</a></td>
    </tr>
  <?php }
    ?>
  </table>
  <?php 
  if(($name!==NULL || $age!==NULL || $gender!==NULL || $income!==NULL || $tend!==NULL)&&($data->num_rows)==0){
    echo '<h2>没有该查询结果！！！</h2>';
  } 
   mysqli_close($conn);
  ?>
</div>
</div>
</body>
</html>