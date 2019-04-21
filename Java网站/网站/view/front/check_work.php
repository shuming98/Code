<?php session_start(); 
require('../../lib/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>Document</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="check_container">
		<!--查询作业-->
		<div class="select_form">
			<p style="float:right">老师好，当前时间：16：36：16</p>
			<div class="clearfix"></div>
			<p style="float:left">作业&gt;<a href="./issue_work.php">发布作业</a>&gt;<a href="./check_work.php" style="color:#26A5FF">批改作业</a></p>
			<div class="clearfix"></div>
			<form action="" method="get">
				<span>班级:</span>
				<select name="class" id="class">
					<option value="选择班级">选择班级</option>
					<option value="16计科">16计科</option>
				</select>
				<span>作业发布时间:</span>
				<input type="date" name="time">
				<input type="submit" value="确定">
			</form>
		</div>
		<div class="clearfix"></div>
		<!--显示查询结果-->
		<div class="select_result">
			<p>当前班级&gt;16计科&gt;2018-4-3</p>
			<table>
				<tr>
					<th>学号</th>
					<th>姓名</th>
					<th>作业情况</th>
					<th>成绩</th>
				</tr>
				<tr>
					<td>1640664100</td>
					<td>好同学</td>
					<td><a href="#" onclick="document.getElementById('check_work').style.display='block'">已交</a></td>
					<td>4</td>
				</tr>
				<tr>
					<td>1640664100</td>
					<td>好同学</td>
					<td><a href="#">已交</a></td>
					<td>4</td>
				</tr>
			</table>
			<p>本次作业：33人已交,5人未交</p>
		</div>
	</div>
	<div class="clearfix"></div>
	<!--显示学生作业_模态框-->
	<div id="check_work" class="modal">
		<div class="check_modal_content animate">
			<div class="check_modal_head">
				<p>老师，你好，今天是2019年4月25号</p>
				<p>你正在批改<b>2019年4月20号</b>发布于<b>16计科</b>班的<b>好同学</b>的作业</p>
				<span class="close" onclick="document.getElementById('check_work').style.display='none'">&times;</span>
			</div>
			<div class="check_modal_issue_work">
				<p>作业标题:完成实验报告4</p>
				<p>作业内容:请独立完成实验报告,并按时上交</p>
				<p>文件下载:<a href="#">点击下载</a></p>
				<p>截止日期:2019年4月23号</p>
			</div>
			<h2>好同学提交的作业:</h2>
			<div class="check_modal_submit_work">
			<p>文本内容:</p>
				<pre>
					<code>
public class Ex4_1 {
	public static void main(String[] args) {
        String str="kennygogo.";
        String str2="kenny123";
        String res="";
        for (int i=0; i&lt;str.length();i++) {
            for(int j=0;j&lt;str2.length();j++){>
                if(str.charAt(i)==str2.charAt(j)){
                    res+=str.charAt(i);
                    break;
                    }
                }
            }
        System.out.println(res);     
        }
    }
				</code>
			</pre>
				<p>文件:<a href="#">下载</a></p>
			</div>
			<form action="#" method="get" accept-charset="utf-8">
				<p>成绩：<input type="text" name="grade" placeholder="请输入该作业得分"></p>
				<p>评语：<input type="text" name="content"></p>
				<input type="submit" name="submit" value="确认">
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
	<!--页尾-->
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>