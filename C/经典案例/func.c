#include <stdio.h>
#include <ctype.h>
void choice(void);
int input(int min,int max);
int main(void)
{
	int res;
	choice();
	while((res=input(1,4))!=4)
	{
		printf("I like choice %d.\n",res);
		choice();
	}
	printf("Bye!\n");
	return 0;
}

void choice(void)
{
	printf("Please choose one of the following:\n");
	printf("1) copy files         2) move files\n");
	printf("3) remove files       4) quit\n");
	printf("Enter the number of your choice:");
}

int input(int min,int max)
{
	int num,a;
	a=scanf("%d",&num);
	while((num<min || num>max) &&a==1)
	{
		printf("%d is not a valid choice;try again\n",num);
		choice();
		scanf("%d",&num);
	}
	if(a!=1)
	{
		printf("quit!\n");
		num=4;
	}
	return num;
}