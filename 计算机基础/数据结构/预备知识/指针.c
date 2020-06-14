#include <stdio.h>

//简单的指针
// int main(void)
// {
// 	int * p;//p是个变量名，只能存储int类型变量的地址。
// 	int i = 10;
// 	int j;

// 	p = &i;//p保存i的地址，p指向i
// 	j = *p;//等价于j = i;
// 	printf("%d",j);
// 	return 0;
// }


//通过被调函数该变主函数的值：传递地址
// void f(int * p)
// {
// 	*p = 100;
// }

// int main(void)
// {
// 	int i = 9;

// 	f(&i);
// 	printf("%d",i);

// 	return 0;
// }


//指针与数组
//传递地址，直接传递数组名
//取地址值，直接当做数组做
// void showArray(int * p,int len)
// {
// 	int i;
// 	for(i = 0;i<len;i++){
// 		printf("%d\n",p[i]);
// 	}
// 	//p[i]就是主函数a[i]
// 	//p[2] = -1; // p[0] == *p , p[2] == *(p + 2) == *(a + 2) == a[2]
// }

// int main(void)
// {
// 	int a[5] = {1,2,3,4,5};
	
// 	showArray(a,5);	//a等价于&a[0]
// 	printf("%d\n",a[2]);

// 	return 0;
// }


//两值交换
// void f(int * a,int * b)
// {
// 	int temp;
// 	temp = *a;
// 	*a = *b;
// 	*b = temp;
// }

// int main(void)
// {
// 	int a = 3;
// 	int b = 4;
// 	f(&a,&b);
// 	printf("a = %d,b = %d\n",a,b);
// 	return 0;
// }

