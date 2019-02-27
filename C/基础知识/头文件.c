#include <stdio.h> 基本输入输出函数
1. printf() scanf()
2. getchar() 输入字符[相当于scanf("%c",ch),但效率更高]
3. putchar() 输出字符

#include <string.h> 字符函数
1.strlen() 判断字符串长度 

#include <ctype.h> 字符函数
1)字符测试函数[真返回非零,假返回0]
1.isalnum() 判断是否为字母数字
2.isalpha() 判断是否为字母
3.isdigit() 判断是否为数字
4.isupper() 判断是否为大写字母
5.islower() 判断是否为小写字母 
6.isspace() 判断是否为空白字符

2)字符映射函数
1.toupper() 返回大写字符
2.tolower() 返回小写字符

#include <stdbool.h>
bool代替_Bool, true 和 false 代替 1 和 0

#include <iso646.h>
and 代替 &&, or 代替 ||, not 代替 !