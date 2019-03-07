#include <stdio.h>
void to_base_n(int num,int scale);
int main(void)
{
	int num,scale;
	printf("please input num and scale(2-10):");
	while(scanf("%d %d",&num,&scale)==2)
	{
		if(scale>10 || scale<2)
		{
			printf("%d is not valid\n",scale);
			printf("please again input num and scale(2-10):");
			continue;
		}
		to_base_n(num,scale);
		putchar('\n');
		printf("please again input num and scale(2-10):");
	}
	printf("Done!\n");
	return 0;
}

void to_base_n(int num,int scale)
{
	int r;
	r=num%scale;
	if(num>=scale)
		to_base_n(num/scale,scale);
	printf("%d",r);
	return;
}