#include <stdio.h>
int main(void)
{
	float pin,bei,ang,tang,cha;
	printf("please input bei num:");
	scanf("%f",&bei);
	printf("pin is %.2f\n",0.5*bei);
	printf("bei is %.2f\n",bei);
	printf("ang is %.2f\n",8*bei);
	printf("tang is %.2f\n",16*bei);
	printf("cha is %.2f\n",48*bei);
	return 0;
}