关于字符串函数会<头文件.c>说明
1.字符串是以空字符(\0)结尾的 char 类型数组,储存在静态存储区
2.字符串定义:char str[256] = "I am a string by array.";
(自动加入\0) const char * p = "I am a string by pointer.";

			char str[5][256] = {
				"First is one",
				"Second is tow",
				"Third is three",
				"Fourth is four",
				"Fifth is five"
			}
			const char *str[5] = {
				"First is one",
				"Second is tow",
				"Third is three",
				"Fourth is four",
				"Fifth is five"
			}

			char **str 与 char *str[] 是等价的

3.指针与字符串(字符串大多数情况下传递的是地址)
字符串绝大多数操作通过指针完成,const 定义的指针指向的字符串不能更改,也建议使用指针
例,指针字符串拷贝(地址)
const char * mesa = "I is strong."；(双引号括起来的内容是字符串常量——字面量)
const char * rhino;
rhino = mesa;

4.字符串函数
	void strrt(char *str[],int num);
