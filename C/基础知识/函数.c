C程序由一个或多个函数组成,函数是C程序的构造块.
C程序一定从 main()函数开始执行.
0.函数定义
  header(函数声明):void Tem(double Tem);  [返回值类型 函数(变量类型 变量名)]
  body(函数定义):void Tem(double Tem){}

1.输出 printf("字符串+转换说明+转义序列",变量,数值,表达式);  [变量与转换说明要一一对应][printf()的返回值是字符个数，即 strlen()]
 
 转换说明：
 	有符号十进制：%d(%i) 无符号十进制：%u 浮点数：%f 指数记数法：%e(%E) 浮点数自动选择：%g(%G)
  	无符号八进制：%o     无符号十六进制：%x(%X)     带前缀八进制：%#o  带前缀十六进制：%#x
  	p记数法：%a(%A)     单个字符：%c 	 字符串：%s 指针：%p         打印%：%%
 
 修辞符：
 	标记：”-“ 左对齐 	   ”+“ 显示符号 	          ”空格“ 正数显示空格，负数加上”-“ 
 	     ”#“ 显示带前缀的八、十六进制，保证浮点数完整 ”0“ 0填充宽度   ”*“ 变宽 如,printf("%*d",5,age)
 	     如,%-10d , %#x0 , % 5.3f 

 	数字(宽度.位数)： 如，%10.5d , %2.6f %4.3g [宽度不足会自动补足] 

 	%h short %hh  unsigned char(signed char)      %t ptrdiff_t    
 	%l long  %ll long long      %L long double    %z sizeof    %j intmax_t



2.输入 scanf("转换说明",&var);                 [说明输入变量的类型,除字符数组外,皆要在变量名前加上一个&]
  转换说明：
  	[scanf()转换说明,与 printf()大体上是一样的]

  修辞符：
  	* 跳过,不赋值 数字 最大字段宽度
  	如,scanf("%*d %f %*d",52.20), scanf("%11d",tel)

3.类型大小 sizeof(int)       (%z)           [指定变量(类型)大小,占多少字节]
4.字符长度 strlen()									[打印字符个数,需要加上<string.h>]

一、函数构造
1.return语句的另一个作用是，终止函数并把控制返回给主函数的下一条语句.
2.命令行参数
	int main(int argc,char *argv[])  //带参数的主函数(字符串数量,指针数组)
	./a.out Mac is "a good" operating system. //执行时添加参数
	//这个执行命令有5个参数,
	//argv[0] -> ./a.out, 
	//argv[1] -> Mac,
	//argv[3] -> "a good", 
	//argv[5] -> system.

