//计算某标签个数
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


<script>
alert('***');
location.href = "url";     //重定向网页
location.replace('url')    //跳转页面并刷新(不记录)
location.replace(document.referrer); //浏览器后退并刷新
location.reload();         //刷新页面
history.go(-1)或history.back(); //浏览器后退
history.go(1)或history.forward(); //浏览器前进
</script>" 