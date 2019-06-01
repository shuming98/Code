#include <stdio.h>
#define gallon 3.785
#define mile 1.609
int main(void)
{
	float km,oil,valid;
	printf("please enter your travel mileage:");
	scanf("%f",&km);
	printf("please enter your oil sp:");
	scanf("%f",&oil);

	valid = (km / mile) / (oil / gallon);
	printf("每加仑汽油行驶的英里数为：%0.1f\n",valid);

	return 0;
}