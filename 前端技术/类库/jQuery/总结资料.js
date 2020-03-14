Jquey 是JavaScript一个库，它主要体现的优势在：选择器、ajax

零、Jquery 与 JavaScript 之间的(对象)关系
0）Jquery对象包含Js对象
1）Jquery转js：$()[0]
2）js转Jquery：$()
3）this是js指代表示方式，$(this)是Jquery指代表示方式，



一、选择器
1）基本选择器
1.id选择器：$("#id").css('attr','value');
2.class选择器：$(".class").css('attr','value');
3.tagName选择器：$("tagName").css('attr','value');

2）层次选择器
4.某标签所有兄弟元素：$("input ~ p").css('attr','value');
5.某标签下一个兄弟元素：$("innput + p").css('attr','value');
6.某父标签下子元素：$("input > span").css('attr','value');

3）属性选择器
7.根据标签属性：$("input[name='text']").css('attr','value');
8.属性值以某字符串开头：$("input[name^='text']").css('attr','value');
9.属性值以某字符串结尾：$("input[name$='text']").css('attr','value');
10.属性值包含某字符串：$("input[name*='text']").css('attr','value');

4）基本过滤器(匹配第一个，返回单一)
11.某元素第一个节点：$("li:first").css('attr','value');
12.某元素最后一个节点：$("li:last").css('attr','value');
13.某元素第n个节点[从0开始]：$("li:eq(n-1)").css('attr','value');
14.某元素奇数节点：$("li:odd").css('attr','value');
15.某元素偶数节点：$("li:even").css('attr','value');

5）子元素过滤器(匹配所有)
16.某标签最后一个兄弟元素：$("li:last-of-type").css('attr','value');
17.某标签第一个兄弟元素：$("li:first-of-type").css('attr','value');
18.父元素下唯一子元素：$("li a:only-child ").css('attr','value');


6）内容过滤器
19.根据文本内容：$("td:container('string')").css('attr','value');
20.内容为空：$("td:empty").css('attr','value');
21.某父元素下有某标签：$("td:has(span)").css('attr','value');
22.某标签是父元素：$("td:parent").css('attr','value');

7）表单过滤器
23.根据属性：$("input [type='password']").css('attr','value');
		    $("input:password").css('attr','value');

8）可见与否过滤器
24.找隐藏元素：$("div:hidden").css('display','block');
25.找可见元素：$("div:visible").css('display','none');

9）进一步筛选过滤器
26.添加去除选择器:not：$(".stu:not(p)").css('display','block');
			   .not：$("p").not(".intro").css('color','red');

27.添加符合选择器：.filter：$("p").filter(".intro").css('color','blue');


二、属性
1.[css]css('attr','value')		$("#id").css('width','300px');
2.[布尔]prop('attr','bool')		$("input:checkbox").prop('checked','true/false');
4.[属性]attr('attr','value') or attr({attr:'value',attr:'value'})  $("img").attr('src','/img.png') // $("img").attr({src:'img.png',alt:'pic'})
5.[移除属性]removeAttr('attr')	$("img").removeAttr('alt');
6.[添加类名]addClass('ClassName') $("div").addClass('c1 c2');
7.[移除类名]removeClass('ClassName') $("div").removeClass('c1');
8.[切换类名]toggleClass('ClassName') $("button").toggleClass('className');
3.[获取标签内容或设置标签内容]html('content')		$("p").html() // $("p").html(“Stu<b>dent</b>”)
4.[获得表单内容或设置表单内容]val('content')			$("input:text").val() // $("input:text").val('form')
5.[获取标签文本内容或设置标签文本内容]tetx('content')	$("p").text() // $('p').text('text')



三、操作节点
1）添加节点
1.往后追加：$("ul").append('<li>233</li>');
		  $('<li>233</li>').appendTo('ul');

2.往前追加：$("ul").prepend('<li>3322</li>');
		  $('<li>3322</li>').prependTo('ul');

3.添加在某元素前：$("img").before('<p>3322</p>');

4.添加在某元素后：$("img").after('<p>233</p>')

2）删除节点
1.删除父子节点：$("ul").remove(); 
2.只删除子节点：$("ul").empty();
3.删除某个节点：$("ul li:first-child").remove()

2）节点包裹添加
1.[包裹它]：$("p").wrap('<b></b>');  --> <b><p>233</p></b>
2.[大包裹]：$("p").wrap('<b></b>');  --> <b><p>233</p><p>233</p></b>
3.[被包裹]：$("p").wrapInner('<b></b>')  --><p><b>233</b></p>

四、遍历
1.for(var i=0;i<div.length;i++)

2.闭包操作：
$("div").each(function(){
	Code...
});


五、事件

1）事件
$("Selector").event(function(){       //如，click,focus,submit,keyup,mouseenter

});

2）ready事件 //DOM加载完毕后执行
$(document).ready(function(){

});

3）一次性绑定 //只触发一次
$("Selector").one('event',function(){

});

4）绑定事件
$("Selector").bind/on('event',function(){

});

5）解绑事件
$("Selector").unbind/off('event',function(){

}); 

6）嵌套事件解决方案
1.不嵌套

2.$("Selector").on('event',function(){
	$("Selector").off("click").on('click',function(){

	});

});


7）事件委托
$("Parent").on('click','Child',function(){

});

8）事件对象
$("Selector").click(function(event){
	event.target
});


六、动画

七、不断学习

1）jquery放js文件不运行，代码外加上
$(document).ready(function(){
	//特别是动态HTML
});

2）嵌套函数获取值
var that = this; 
$(that).date();

3）获取自定义data-*的值
1.$("Selector").data('*');
2.$("Selector").attr('data-*');
3.div.getAttribute('data-*');[JS方式]

