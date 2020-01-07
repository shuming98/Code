（[类型]转换说明,结果显示取决于你用什么类型转换）
一、整型(溢出会周期性，重新从起始点开始)
  int (十进制 %d ,八进制 %o ,十六进制 %x ,显示前缀0八进制 %#o ,显示前缀x0十六进制 %#x 或 %#X)
  unsigned = unsigned int   (%u)  
  short = short int         (%hd)  16位 65536
  long  = long int          (%ld)  32位 42亿  数值加上 L 表示long整型,如50L
  long long = long long int (%lld) 64位 1.8e19 数值加上 LL 表示long long整型,如200LL

  可移植类型：<stdint.h><inttypes.h> 这两个头文件提供了 int 别名集合  如,int32_t

二、字符型(技术层面上是整型)
  char (%c,%d),如 char ch=95(会根据ASCII码转换成字符),
  					   ch='A'(字符常量),
                       ch=var(变量名赋值),
                       ch="str"(字符串)
                       ch="\n"(转义序列)

  *常用转义序列：\a 警报 \b 退格 \f 换页 \n 换行 \r 回车,移到行首 \t 制表 \v 垂直制表
               \\ \' \" \? 输出字符\'"?      \0 八进制形式 \x 十六进制形式表示ASCII码'

   可加上 unsigned 或 signed 关键字,unsigned 用于小数运算

   *声明字符串用数组：如 char name[30];  （%s）（以空字符\0’结束,意味着数组容量要比存储字符多1）
    打印较长字符串方法：①分开多个 printf()写;②分开多个”双引号“写;③加”\“回车

三、浮点型
  float       (%f)   32位   数值加上 f 或 F 表示float           [精确到.6f]
  double      (%f)   64位                                    [精确到.15f]
  long double (%lf)  128位  数值加上 l 或 L 表示long double

  指数计数法(e计数法)(%e) 如,2.0e20 = 2.0*10^20   6.63e-34 = 6.63*10^-34
  p计数法[16进制.p2的指数](%a 或 %A)  如,0xa.1fp10 = 0xa.1f*2^10

四、布尔型(实际上也是整型)
  _Bool 逻辑判断 true false [0为假,非0为真]

五、复数和虚数浮点数类型(浮点型基础上)
  float _Complex       64位
  double _Complex      128位
  long double _Complex

  float _Imaginary
  double _Imaginary
  long double _Imaginary

  添加头文件<complex.h>,可直接用 complex 和 imaginary 作为关键字

 **如何声明变量
 ①int var;
 ②long long var=23;
 ③float var,var2,var3;

六、数组
1.声明数组：int array[20] 可存储20个元素,下标[0~19].
2.字符数组包含于字符串.
3.输入字符串不需要加&,输入单个数组下标需要加&.

七、知识
 1.为现有类型创建别名:typeof  如:typeof unsigned int uint; uint num;
 2.强制类型转换:moeny = (int)1.7 + 2;  [ (类型)值/变量名 ]
 3.实参:值、表达式;  形参:变量
 
