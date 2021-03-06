/*斐波那契数列*/
#include <stdio.h>
#include <time.h>
#include <stdlib.h>
unsigned long fib(unsigned n);
void fib_for(unsigned n);
int main(void)
{
	unsigned n,result;
	clock_t start,end;
	printf("please input a num:");
	while(scanf("%u",&n)==1)
	{
		start=clock();
		//fib_for(n);
		result = fib(n);
		printf("第%d个数 is %u.\n",n,result);
		end=clock();
		
		printf("spend time is %lf\n",(double)(end-start)/CLOCKS_PER_SEC);
		printf("please again input a num(q to quit):");
	}
	return 0;
}
//递归
unsigned long fib(unsigned n)
{
	if(n>2)
		return fib(n-1) + fib(n-2);
	else 
		return 1;
}
//循环
void fib_for(unsigned n)
{
	int i,fib,fib1=1,fib2=1;
	for(i=3;i<=n;i++)
	{
		fib=fib1+fib2;
		fib1=fib2;
		fib2=fib;
	}
	printf("第%d个数 is %d.\n",n,fib);
}