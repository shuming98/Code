#include <stdio.h>
#include <malloc.h>
#include <stdlib.h>

struct Arr
{
	int len; //最大长度
	int * pBase; //第一个元素地址
	int cnt; //有效的元素个数
};

void init_arr(struct Arr * pArr, int length);
bool is_empty(struct Arr * pArr);
bool is_full(struct Arr * pArr);
bool append_arr(struct Arr * pArr, int val);
bool insert_arr(struct Arr * pArr, int pos, int val);
bool delete_arr(struct Arr * pArr, int pos, int * pVal);
bool invert_arr(struct Arr * pArr);
bool sort_arr(struct Arr * pArr);
void show_arr(struct Arr * pArr);

int main(void)
{
	struct Arr arr;
	int val;

	init_arr(&arr, 6);
	append_arr(&arr, 1);
	append_arr(&arr, 3);
	append_arr(&arr, 4);
	append_arr(&arr, 7);

	insert_arr(&arr, 1, 10);
	delete_arr(&arr, 3, &val);

	show_arr(&arr);

	invert_arr(&arr);
	show_arr(&arr);

	sort_arr(&arr);
	show_arr(&arr);

	return 0;
}

void init_arr(struct Arr * pArr, int length)
{
	pArr->pBase = (int *)malloc(sizeof(int) * length);
	pArr->len = length;
	pArr->cnt = 0;

	return;
}

//判断数组是否为空
bool is_empty(struct Arr * pArr)
{
	if (0 == pArr->cnt)
		return true;
	else
		return false;
}

//判断数组是否为满
bool is_full(struct Arr * pArr)
{
	if (pArr->cnt == pArr->len)
		return true;
	else
		return false;
}

//追加元素
bool append_arr(struct Arr * pArr, int val)
{
	if (is_full(pArr))
		return false;

	pArr->pBase[pArr->cnt] = val;
	(pArr->cnt)++;
	return true;
}

//添加元素到指定位置，元素后移
//pos 从 1 开始
bool insert_arr(struct Arr * pArr, int pos, int val)
{
	if (is_full(pArr))
		return false;

	if (pos < 1 || pos > pArr->len)
		return false;

	for (int i = pArr->cnt; i >= pos; i--)
	{
		pArr->pBase[i] = pArr->pBase[i-1];
	}
	pArr->pBase[pos-1] = val;
	(pArr->cnt)++;

	return true;
}

//删除指定位置的元素，元素往前移
//pos 从 1 开始
bool delete_arr(struct Arr * pArr, int pos, int * pVal)
{
	if (is_empty(pArr))
		return false;

	if (pos < 1 || pos > pArr->cnt)
		return false;

	*pVal = pArr->pBase[pos-1];
	for (int i = pos; i < pArr->cnt; i++)
	{
		pArr->pBase[i-1] = pArr->pBase[i];
	}
	(pArr->cnt)--;
	return true;
}

//倒置/逆向输出
bool invert_arr(struct Arr * pArr)
{
	if(is_empty(pArr))
		return false;

	int temp, i, j;

	for (i = 0, j = pArr->cnt - 1; i < pArr->cnt/2; i++, j--)
	{
		temp = pArr->pBase[i];
		pArr->pBase[i] = pArr->pBase[j];
		pArr->pBase[j] = temp;
	}

	return true;
}

//从小到大排序
bool sort_arr(struct Arr * pArr)
{
	int temp, i, j;

	for (i = 0; i < pArr->cnt - 1; i++)
	{
		for(j = i + 1 ; j < pArr->cnt; j++)
		{
			if(pArr->pBase[i] > pArr->pBase[j])
			{
				temp = pArr->pBase[i];
				pArr->pBase[i] = pArr->pBase[j];
				pArr->pBase[j] = temp;
			}
		}
	}

	return true;
}

//打印数组
void show_arr(struct Arr * pArr)
{
	if (is_empty(pArr))
		printf("数组为空！\n");

	for (int i = 0; i < pArr->cnt; i++)
		printf("%d ", pArr->pBase[i]);
	
	printf("\n");

	return;
}