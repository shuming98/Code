#include <stdio.h>
void Temperature(double huashi);
int main(void){
	double huashi;
	printf("Enter a huashi Temperature:");
	while (scanf("%lf",&huashi)==1){
	Temperature(huashi);
	printf("Enter a huashi Temperature:(no num will to quit):");
	}
	printf("Done!\n");
	return 0;

}
void Temperature(double huashi){
	const double sheshi = 5.0/9.0*(huashi - 32.0);
	const double kaishi = sheshi + 273.16;
	printf("huashi is %.2lf\nsheshi is %.2lf\nkaishi is %.2lf\n",huashi,sheshi,kaishi);
}