#include <stdio.h>
void interchange(double * x,double * y,double * z);
int main(void)
{
	double x = 5.3,y=11.6,z=5.7;
	printf("Originally x = %.2lf , y = %.2lf and z = %.2lf\n",x,y,z);
	interchange(&x,&y,&z);
	printf("Now x = %.2lf , y = %.2lf and z = %.2lf\n",x,y,z);

	return 0;
}

void interchange(double * x,double * y,double * z)
{
	double temp;
	if(*x > *y)
	{
		temp = *x;
		*x = *y;
		*y = temp;
	}
	if(*x > *z)
	{
		temp = *x;
		*x = *z;
		*z = temp; 
	}
	if(*y > *z)
	{
		temp = *y;
		*y = *z;
		*z = temp;
	}
	return;
}