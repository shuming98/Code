#include <stdio.h>
void input_arr(double arr[][5],int rows);
double avg_arr_rows(double arr[],int cols);
void avg_arr_all(double arr[][5],int rows);
void max_arr(double arr[][5],int rows);
void print_arr(double arr[][5],int rows);
int main(void)
{
	double arr[3][5];

	input_arr(arr,3);
	putchar('\n');

	print_arr(arr,3);
	putchar('\n');

	for(int i=0;i<3;i++)
		printf("%d group average result is %.1lf\n",i+1,avg_arr_rows(arr[i],5));
	putchar('\n');

	avg_arr_all(arr,3);
	putchar('\n');

	max_arr(arr,3);
	putchar('\n');

	print_arr(arr,3);
	putchar('\n');

	return 0;
}

void input_arr(double arr[][5],int rows)
{	
	printf("please input 15 numbers:\n");
	for(int i=0;i<rows;i++){
		for(int j=0;j<5;j++){
			scanf("%lf",&arr[i][j]);
			getchar();
		}
	}
}

double avg_arr_rows(double arr[],int cols)
{
	double sum=0;
	for(int i=0;i<cols;i++){
		 sum+=arr[i];
	}
	return (sum / cols);
}

void avg_arr_all(double arr[][5],int rows)
{
	double sum=0;
	for(int i=0;i<rows;i++){
		for(int j=0;j<5;j++)
			sum+=arr[i][j];
	}
	printf("The array average is %.1lf\n",sum/(rows*5));
}

void max_arr(double arr[][5],int rows)
{
	double max=arr[0][0];
	for(int i=0;i<rows;i++){
		for(int j=0;j<5;j++){
			if(arr[i][j]>max)
				max=arr[i][j];
		}
	}
	printf("The array max is %.1lf\n",max);
}

void print_arr(double arr[][5],int rows)
{
	printf("arr result:\n");
	for(int i=0;i<rows;i++){
		for(int j=0;j<5;j++)
			printf("%5.1lf",arr[i][j]);
		putchar('\n');
	}
}