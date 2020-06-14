# include <stdio.h>
# include <malloc.h>

//动态分配内存
int main(void)
{
	//输出数组长度
	int len;
	printf("please input the arr length:");
	scanf("%d", &len);

	//分配多少字节的内存，并把指向的第一个地址强转换为int类型指针
	int * pArr = (int *)malloc(sizeof(int) * len);

	//循环输入和输出
	printf("please input five number:");
	for(int i = 0; i < len; i++)
		scanf("%d", &pArr[i]);

	for(int i = 0; i < len; i++)
		printf("%d\n", *(pArr+i));

	//释放内存
	free(pArr);

	return 0;
}