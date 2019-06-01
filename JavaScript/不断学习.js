//计算有标签个数
①$("table tr").length
②document.getElementById("table_Id").getElementsByTagName("tr").length;

//JavaScript输出方式
①alert('')           弹窗
②document.write("") 写入html文件,里面可直接写html代码
③innerHTML=""        写入HTML元素
④console.log()      写入浏览器控制台

//表单控制
①只能输入数字 oninput="value=value.replace(/[^\d]/g,'')"
②只能输入数字和字母 oninput="value=value.replace(/[\W]/g,'')"
oninput="value=value.replace(/[^A-D]/g,'')"

//ajax
$.post提交表单data:①$("form").serialize()
				  ②$("form").serializeArray()


//jquery
①jquery放js文件不运行，外加上
	$(document).ready(function(){
		//特别是动态HTML
	});

②关门提交表单:var that = this; $(that).date();