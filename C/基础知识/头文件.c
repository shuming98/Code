[函数名全称]
#include <stdio.h> 基本输入输出函数
1. scanf()[scan formatted]   
2. printf()[print formatted] 
3. getchar() 输入字符[相当于scanf("%c",ch),但效率更高]
4. putchar() 输出字符
5. 字符串输入函数
   gets(str);  //无法检查溢出,已被淘汰
   fgets(str,max_strlen,stdin);  //会读取换行符之前的内容,但会存储‘\n’
   gets_s(str,max_strlen);  //不会储存‘\n’,与gets()一样
   scanf("%10s",str);       //会读取10个字符,但读到回车或空白字符就结束
6. 字符串输出函数
   puts(str);     //把字符串地址作为参数传递,打印字符串,自动换行(打印回车)
   fputs(str);    //打印字符串,不打印回车[与fgets()配套使用]
   printf("%s\n",str);
   sprintf(arr,"%s\n",str);[string printf] 把输出结果存储在arr数组上,而不输出至屏幕上[重定向]

#include <stdlib.h> 其他标准函数库
1.atof(str)[ASCII to float]  把字符串转换为 double 型(开头必须有数字,结尾不能是“e or E”)
2.atol(str)[ASCII to long int]  把字符串转换为 long int 型(开头必须是数字(可以加空格和正负符号),遇到非数字就结束)
3.atoi(str)[ASCII to integer]  把字符串转换为 int 型（开头必须是数字,遇到非数字就结束）


#include <string.h> 字符函数
1.strlen()[length] 统计字符串长度,不包括空字符
2.strcat(str,str2)[string concatenate] 拼接字符串,把str2备份附加到str末尾
3.strncat(str,str2,max_joint) 设定拼接字符串str2最大数
4.strcmp(str,str2)[compare] 比较字符串,相等返回0,大于返回正整数,小于返回负整数
5.strncmp(str,str2,max_cmp) 设定比较字符串最大数
6.strcpy(str,str2)[copy] 拷贝str2字符串给str(目标,源)
7.strncpy(str,str2,max_cpy) 拷贝的最大字符数
8.strchr(str,ch)[character] 查找ch字符在str中首次出现的位置
9.strrchr(str,ch) 查找ch字符在str中最后出现的位置
10.strpbrk(str,str2)[pointer break] 查找str2任意字符在str中首次出现的位置(返回地址)
11.strstr(str,str2)[string] 查找str2字符串在str首次出现的位置



#include <ctype.h> 字符函数
1)字符测试函数[真返回非零,假返回0]
1.isalnum() 判断是否为字母数字
2.isalpha() 判断是否为字母
3.isdigit() 判断是否为数字
4.isupper() 判断是否为大写字母
5.islower() 判断是否为小写字母 
6.isspace() 判断是否为空白字符
7.ispunct() 判断是否为标点符号
8.isprint() 判断是否为可打印字符
9.isgraph() 除空格外可打印字符
10.iscntrl() 判断是否为控制字符
11.toupper() 转换字符为大字字母
12.tolower() 转换字符为小写字母

2)字符映射函数
1.toupper() 返回大写字符
2.tolower() 返回小写字符

#include <stdbool.h>
bool代替_Bool, true 和 false 代替 1 和 0

#include <iso646.h>
and 代替 &&, or 代替 ||, not 代替 !