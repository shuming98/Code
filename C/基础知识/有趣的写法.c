1.while(scanf("%lf",&tem)==1){printf}
	循环交互输入,判断输入值是否为数字,是则执行,不是则退出。[scanf返回值,是数字返回1,否则返回0][两个输入返回2,以此类推]

2.倒序输出
	for(i=0;i<num;i++){输入}
	for(j=i;j>0;j--){输出}

3.幂函数定义
	double power(double a,double b)
	{
		double sum,i;
		sum=1;
		for(i=0;i<b;i++)
		{
			sum*=a;
		}
	}