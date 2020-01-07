#include <stdio.h>
void input_arr(int rows,int cols,double arr[rows][cols]);
double avg_arr_rows(int cols,double arr[cols]);
void avg_arr_all(int rows,int cols,double arr[rows][cols]);
void max_arr(int rows,int cols,double arr[rows][cols]);
void print_arr(int rows,int cols,double arr[rows][cols]);
int main(void)
{
	int rows=3,cols=5;
	double arr[rows][cols];

	input_arr(3,5,arr);
	putchar('\n');

	print_arr(3,5,arr);
	putchar('\n');

	for(int i=0;i<rows;i++)
		printf("%d group average result is %.1lf\n",i+1,avg_arr_rows(cols,arr[i]));
	putchar('\n');

	avg_arr_all(3,5,arr);
	putchar('\n');

	max_arr(3,5,arr);
	putchar('\n');

	print_arr(3,5,arr);
	putchar('\n');

	return 0;
}

void input_arr(int rows,int cols,double arr[rows][cols])
{	
	printf("please input 15 numbers:\n");
	for(int i=0;i<rows;i++){
		for(int j=0;j<cols;j++){
			scanf("%lf",&arr[i][j]);
			getchar();
		}
	}
}

double avg_arr_rows(int cols,double arr[])
{
	double sum=0;
	for(int i=0;i<cols;i++){
		 sum+=arr[i];
	}
	return (sum / cols);
}

void avg_arr_all(int rows,int cols,double arr[rows][cols])
{
	double sum=0;
	for(int i=0;i<rows;i++){
		for(int j=0;j<cols;j++)
			sum+=arr[i][j];
	}
	printf("The array average is %.1lf\n",sum/(rows*cols));
}

void max_arr(int rows,int cols,double arr[rows][cols])
{
	double max=arr[0][0];
	for(int i=0;i<rows;i++){
		for(int j=0;j<cols;j++){
			if(arr[i][j]>max)
				max=arr[i][j];
		}
	}
	printf("The array max is %.1lf\n",max);
}

void print_arr(int rows,int cols,double arr[rows][cols])
{
	printf("arr result:\n");
	for(int i=0;i<rows;i++){
		for(int j=0;j<cols;j++)
			printf("%5.1lf",arr[i][j]);
		putchar('\n');
	}
}