#include <stdio.h>
int main(void)
{
	while(1)
	{
		printf("Enter the operation of your choice:\n");
		printf("a. add           s. subtract\n");
		printf("m. multiply      d. divide\n");
		printf("q. quit\n");

		float a,b,sum;
		char ch;
		ch = getchar();

		printf("Enter first number:");
		scanf("%f",&a);
		printf("Enter second number:");
		scanf("%f",&b);

		switch(ch)
		{
			case 'a':sum=a+b;break;
			case 's':sum=a-b;break;
			case 'm':sum=a*b;break;
			case 'd':sum=a/b;break;
			case 'q':printf("quit!");return 0;
			default:continue;
		}


		printf("sum:%3.1f\n\n",sum);
	}
	return 0;
}

}