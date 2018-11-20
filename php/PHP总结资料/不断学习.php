<?php 
echo "<script>alert('***');
header('location:url');    //跳转到url页面
location.replace('url')    //跳转页面并刷新
location.replace(document.referrer); //浏览器后退并刷新
location.reload();         //刷新页面
history.go(-1)或history.back(); //浏览器后退
history.go(1)或history.forward(); //浏览器前进
</script>" 

 ?>