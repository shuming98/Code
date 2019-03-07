#include <stdio.h>
double power(double a,double b);
int main(void)
{
	double a,b;
	double sum;
	printf("please input two number:");
	while(scanf("%lf %lf",&a,&b)==2)
	{
		sum = power(a,b);
		printf("a is %5.2lf\nb is %5.2lf\nsum is %+5.2lf\n",a,b,sum);
		printf("please again input two number(q to quit):");
	}
	return 0;
}

double power(double a,double b)
{
	int i;
	double sum=1;
	if(b>0)
	{
		for(i=1;i<=b;i++)
			sum*=a;
	}

	if(b<0)
	{
		for(i=0;i>b;i--)
			sum*=1/a;
	}

	if(a==0)
		sum=0;
	if(a!=0 && b==0)
		sum=1;
	if(a==0 && b==0)
	{
		printf("input irregular!\n");
		sum = 1;
	}
	return sum;
}