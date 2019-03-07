三种循环语句：(基本三要素：初始化、判断条件/表达式、更新)
如何选择循环语句？判断表达式多采用while，计数多采用for
		
1.入口条件循环
	初始化
	while(判断条件)
		{
			执行;
			更新;
		}

2.出口条件循环[先执行一次后再判断循环条件]
	初始化
	do
		{
			执行;
			更新;
		}while(判断条件);

3.for循环灵活性
	for(初始化;判断条件;更新) [循环开始时;每次循环之前;每次循环之后]
		{
			执行;
		}

4.与循环类似的一种算法:递归(recursion):函数调用自身
	1）每级函数都有自己的变量；
	2）每次函数调用都会返回一次，传回上一级递归；
	3）递归函数之前的语句，顺序执行；
	4）递归函数之后的语句，倒序执行；
	5）递归调用与循环类似，效率比循环慢；
	6）必须包含能让递归调用停止的语句。比如，if或其他等价测试条件
	7）尾递归，即正好在return之前，相当于循环