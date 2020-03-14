//JS 5种基本数据类型
Number、String、Boolean、Null、Undefined

//JS 常用三类对象
Javascript(本地对象和内置对象)、Browser对象（BOM）、HTML DOM对象


//计算某标签个数
①$("table tr").length
②document.getElementById("table_Id").getElementsByTagName("tr").length;

//JavaScript输出方式
①alert('')           弹窗
②document.write("") 写入html文件,里面可直接写html代码
③innerHTML=""        写入HTML元素
④console.log()      写入浏览器控制台

//表单控制输入字段
①只能输入数字 oninput="value=value.replace(/[^\d]/g,'')"
②只能输入数字和字母 oninput="value=value.replace(/[\W]/g,'')"
oninput="value=value.replace(/[^A-D]/g,'')"

//ajax
$.post提交表单data:①$("form").serialize()
				  ②$("form").serializeArray()


//页面重定向/跳转
alert('***');
location.href = "url";     //重定向网页
location.replace('url')    //跳转页面并刷新(不记录)
location.replace(document.referrer); //浏览器后退并刷新
location.reload();         //刷新页面
history.go(-1)或history.back(); //浏览器后退
history.go(1)或history.forward(); //浏览器前进

//弹出对话框函数
alert()	消息框
prompt() 输入框
confirm() 确认框

//提交某表单
document.forms //获取所有表单
document.forms[0] //获取第一个表单
document.forms[formName].submit();

//打开新窗口
window.open(url,name,specs,replace)
//返回创建该窗口的对象
window.opener.

//创建数组
var arr = [1,2,3];
var arr = new Array(1,2,3);

//判断变量类型
arr instanceof Array

//length对象
obj.length 	//统计字符串长度,一维数组个数
obj.length = n //给length对象赋值可以改变变量的长度，
	n<obj.length //删除，
	n>obj.length //添加一个undefined变量

//Js创建标签
new Image();
document.createElement('image')
obj.innerHTML = '<img />'
document.body(obj).appendChild() //添加对象至html


//JS自带函数(方法)
form.submit() //提交表单
obj.select() //选中输入框所有文字
arr.splice(从何处删添,删除几个,添加xx...)
	arr.splice(2,1); //删除数组第三个元素
	arr.splice(3,0,'a','b'); //数组第四下标开始添加元素a,b

str.indexOf()
	str.indexOf($ch) 返回字符串第一次索引位置
	str.indexOf($ch,$fromindex) 从formindex开始查找第一次索引位置

str.toLocaleUpperCase() 
str.toUpperCase() //字符串全转为大写字母