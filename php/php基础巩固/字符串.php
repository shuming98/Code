<?php
/*
//一、字符串的定义方式:
① $str1='hello';    //单引号里所有字符皆为普通字符，除\' , \\ （\使\和'变得普通字符）   

② $str2="hello";    //双引号里可存在特殊含义字符，如\n,\t,$a等

③ $str3=<<<TEXT      //heredoc 存在特殊含义字符
geie\tiwfewfw
TEXT;
echo $str3;

echo '<br />';

④ $str4=<<<'TEXT'   //nowdoc ，多了个‘’ 不存特殊含义字符
fwfh\tu \n wwf 
TEXT;
echo $str4;

二、字符串常用函数
   strlen(变量)               获得字符串字节长度
   mb_strlen(变量，‘utf-8’)   计算字符长度（个数）
   strpos(找谁，在哪找【变量】)  查找字符串位置
   str_replace(search, replace, subject) 替换字符串
   strtr(待替换字符, array(''=>''))     批量替换字符，数组形式出现，左替换右
   substr(字符，从哪截，截到哪)      截取自字符串   数字表示，最左从0开始，最右从负数开始 cut
   explode(分隔符, 字符)        拆分字符 awk 成数组
   implode(字符（如,））, 数组)         数组融合成字符串
   strtolower(字符)           字符串转换成小写子母 ----正文
   strtoupper(string)        字符串转换成大写子母 ----大标题
   ucfirst(str)              第一个字符大写      ----句子
   ucwords(str)              每个单词首字母大写   ----标题
   strcmp(str1, str2)        字符串比较（区分大小写）
   strcasecmp(str1, str2)    字符串比较（不区分大小字）
   number_format(number)     以千位分割符方式格式化一个数字
   count(var)                统计数组中元素个数
   strrev(var)               字符串翻转
   */
   //作业：
   //一、分割数字
   echo number_format(123456789);
   echo '<br />';
   //二、获得文件扩展名
   var_dump(substr('dir/upload.image.jpg,',-4));
   echo '<br />';
   var_dump(substr('dir/upload.image.jpg,',-5,-1));
   echo '<br />';
   //三、strlen 与mb_strlen
   $a='good night';
   $b='中国人晚上好';
   echo strlen($a);
   echo '<br />';
   echo mb_strlen($b,'utf-8');
   echo '<br />';
   //四、字符串strlen和数组count取长度
   $c=gwng;
   echo strlen($c);
   echo '<br />';
   $arr = array('1' =>学生,‘2’=>课程,'3'=>成绩 );
   echo count($arr);
   echo '<br />';
   $d=abcde123;
   echo strrev($d);
   echo '<br />';
   //五、倒转义字符
   $str  =  "Is your name O'reilly?" ;
   echo  addslashes ( $str );
   echo '<br />';
   //六、==(值相等) 与 ===（值和类型均相等）
   $e=123;
   $f='123';
   echo $e==$f?'等':'不等';
   var_dump($e==$f);
   echo '<br />';
   echo $e===$f?'等':'不等';
   var_dump($e===$f);
   echo '<br />';
   //七、打印出第一个字符
   $g=abcde;
   echo substr($g, 0,1);  //一种是截取
   echo $g{2};            //另一种是用数组抽取,把字符串当作数组处理，{0}与[0]是一样的
   echo '<br />';
   //首字符大写
   $h='my name,this is well';
   echo ucfirst($h);
   echo '<br />';
   echo ucwords($h);
   echo '<br />';
   echo strtolower($h);
   echo '<br />';
   echo strtoupper($h);
   echo '<br />';
   //字符比较  
   $k=abc123;
   var_dump(strcmp($k,abc123));  //返回 int(0) =>true;多N个(1),少N个(-N)

?>