#include <stdio.h>
#include <math.h>
int main(void)
{
	int input;
	printf("please input a num:");
	scanf("%d",&input);

	int i=0;
	int j=0;
	int k=0;

	for(i=2;i<=input;i++)
	{
		for(j=2;j<sqrt((double)i);j++)
		{
			if(i%j==0)
				break;
		}
	if(j>sqrt(i))
	{
		printf("%5d",i);
		k++;
		if(k%8==0)
			printf("\n");
	}
	}
	printf("\n");
}	