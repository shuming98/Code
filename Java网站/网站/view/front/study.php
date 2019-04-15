<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>学习园地</title>
</head>
<body>
	<!--导航栏-->
	<?php include('./nav.php'); ?>
	<div class="study_container">
		<div class="study_container_left">
			<button type="button"><a href="#">发布文章</a></button>
			<p>知识树</p>
			<ul id="treeview">
				<li><span class="caret">认识变量</span>
					<ul class="nested">
						<li><a href="#">声明变量</a></li>
						<li><a href="#">Primitive主数据类型</a></li>
						<li><a href="#">Java关键字</a></li>
						<li><a href="#">引用变量</a></li>
						<li><a href="#">对象的声明与赋值</a></li>
						<li><a href="#">可回收堆空间</a></li>
					</ul>
				</li>
				<li><span class="caret">Swing组件</span>
					<ul class="nested">
						<li><a href="#">BorderLayout</a></li>
						<li><a href="#">FlowLayout</a></li>
						<li><a href="#">BoxLayout</a></li>
						<li><a href="#">JTextField</a></li>
						<li><a href="#">JTextArea</a></li>
						<li><a href="#">JCheckBox</a></li>
						<li><a href="#">JList</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="study_container_right">
			<h1>估计要使用frame and iframe</h1>
			<p>阅读：5</p>
			<hr>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script>
	var toggler = document.getElementsByClassName("caret");
	var i;
	for(i=0;i<toggler.length;i++){
	  toggler[i].addEventListener("click",function(){
	  this.parentElement.querySelector(".nested").classList.toggle("active");
	  this.classList.toggle("caret_down");
  });
}
</script>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>