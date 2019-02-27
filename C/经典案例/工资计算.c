#include <stdio.h>
#define work_week 40
int main(void)
{
	double salary_month,tax,income,salary;
	int work_time;
	while(1){
	printf("*****************************************************************\n");
	printf("Enter the number corresponding to the desired pay rate or action:\n");
	printf("1) $8.75/hr                           2) $9.33/hr\n");
	printf("3) $10.00/hr                          4) $11.20/hr\n");
	printf("5) quit\n");
	printf("*****************************************************************\n");

	int num;
	printf("please input a num to operation:");
	scanf("%d",&num);
	switch(num)
	{
		case 1:salary = 8.75;break;
		case 2:salary = 9.33;break;
		case 3:salary = 10.00;break;
		case 4:salary = 11.20;break;
		case 5:printf("Done!\n");return 0;
		default:continue;
	}

	printf("plz input work time in a week:");
	scanf("%d",&work_time);
	if(work_time<=work_week)
		salary_month=salary*work_time;
	if(work_time>work_week)
		salary_month=work_week*salary+(work_time - work_week)*1.5*salary;
	if(salary_month<=300)
	{
		tax=salary_month * 0.15;
		income=salary_month - tax;
	}
	if(salary_month>300&&salary_month<=450)
	{
		tax=45+(salary_month - 300)*0.2;
		income = salary_month - tax;
	}
	if(salary_month>450)
	{
		tax = 75 + (salary_month - 450) * 0.25;
		income = salary_month - tax;
	}
	printf("work_time:%d\nsalary_month:%.1lf\ntax:%.1lf\nincome:%.1lf\n\n\n\n",work_time,salary_month,tax,income);
	}
	return 0;
}