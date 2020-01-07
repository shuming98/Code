#include <stdio.h>
int main(void)
{
    int Rab = 5;
    int i;
    for(i=1;Rab<15000;i++)
    {
    	Rab=(Rab-i)*2;
    	printf("%2d week has %3d friends.\n",i,Rab);
    }

    return 0;
}