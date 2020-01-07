#include <stdio.h>
int main(void)
{
	char ch;
	double price;
	int pounds,all_pounds,n_onion=0,n_beet=0,n_carrot=0;
	while('q'!=ch){
		printf("*****************************\n");
		printf("a)buy onion  $2.05/pound\n");
		printf("b)buy beet   $1.15/pound\n");
		printf("c)buy carrot $1.09/pound\n");
		printf("q)exit\n");
		printf("*****************************\n\n");


		printf("please input char to select one item:");
		ch=getchar();

		switch(ch)
		{
			case 'a':
				price=2.05;
				printf("please input you need buy the pounds:");
				scanf("%d",&pounds);
				n_onion+=pounds;
				break;
			case 'b':
				price=1.15;
				printf("please input you need buy the pounds:");
				scanf("%d",&pounds);
				n_beet+=pounds;
				break;
			case 'c':
				price=1.09;
				printf("please input you need buy the pounds:");
				scanf("%d",&pounds);
				n_carrot+=pounds;
				break;
			case 'q':continue;
			default:break;
		}
		while(getchar()!='\n');
	}


		double cost,all_cost,carriage;
		all_pounds=n_onion+n_beet+n_carrot;
		cost = 2.05*n_onion + 1.15*n_beet + 1.09*n_carrot;
		if(cost>=100)
			cost*=0.95;
		if(all_pounds<=5)
			carriage=6.5;
			all_cost=cost+carriage;
		if(all_pounds>5&&all_pounds<=20)
			carriage=14;
			all_cost=cost+carriage;
		if(all_pounds>20)
			carriage=14+(all_pounds-20)*0.5;
			all_cost=cost+carriage;

		printf("洋藓采购价格:%3.2lf,采购的重量:%3d\n",2.05,n_onion);
		printf("甜菜采购价格:%3.2lf,采购的重量:%3d\n",1.15,n_beet);
		printf("胡萝卜采购价格:%3.2lf,采购的重量:%3d\n",1.09,n_carrot);
		printf("订购总重量:%d\n",all_pounds);
		printf("蔬菜费用:%3.2lf\n",cost);
		if(cost>=100)
		printf("折扣:%%5\n");
		printf("运费和包装费:%3.2lf\n",carriage);
		printf("订单总费用:%3.2lf\n\n",all_cost);
		return 0;
}