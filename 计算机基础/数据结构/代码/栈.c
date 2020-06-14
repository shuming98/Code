#include <stdio.h>
#include <malloc.h>
#include <stdlib.h>

//定义指针
typedef struct Node
{
	int data;
	struct Node * pNext;
}NODE, * PNODE;

//定义栈
typedef struct Stack
{
	PNODE pTop; //指向栈顶部
	PNODE pBottom; //指向栈底部
}STACK, * PSTACK;

void init(PSTACK pS);
bool is_empty(PSTACK pS);
bool push(PSTACK pS, int val);
bool pop(PSTACK pS, int * pval);
void traverse(PSTACK pS);
void clear(PSTACK pS);

int main(void)
{
	STACK S;
	int val;

	init(&S);
	push(&S, 3);
	push(&S, 1);
	push(&S, 23);
	push(&S, 5);

	traverse(&S);

	if (pop(&S, &val))
	{
		printf("出栈成功, 删除元素为： %d\n", val);
	} else {
		printf("出栈失败");
	}

	traverse(&S);
	clear(&S);
	traverse(&S);
}

//栈初始化
//pTop and pBottom 均指向一个头结点
void init(PSTACK pS)
{
	//pTop 指向头结点
	pS->pTop = (PNODE)malloc(sizeof(NODE));

	if (NULL == pS->pTop)
	{
		printf("栈动态分配内存失败！\n");
		exit(-1);
	} else {
		pS->pBottom = pS->pTop;
		pS->pTop->pNext = NULL;
	}

	return;
}

//判断是否为空
bool is_empty(PSTACK pS)
{
	if (pS->pTop == pS->pBottom)
		return true;
	else
		return false;
}


//入栈
bool push(PSTACK pS, int val)
{
	//定义一个结点
	PNODE pNew = (PNODE)malloc(sizeof(NODE));

	if (NULL == pNew)
	{
		printf("入栈动态分配内存失败\n");
		return false;
	} else {
		pNew->data = val;
		pNew->pNext = pS->pTop;
		pS->pTop = pNew;

		return true;
	}
}

//出栈
bool pop(PSTACK pS, int * pval)
{
	if (is_empty(pS))
		return false;

	PNODE r = pS->pTop;
	*pval = r->data;
	pS->pTop = r->pNext;
	free(r);
	r = NULL;

	return true;
}

//遍历
void traverse(PSTACK pS)
{
	//定义一个p指针遍历，不移动pTop指针
	PNODE p = pS->pTop;

	while (p != pS->pBottom)
	{
		printf("%d ", p->data);
		p = p->pNext;
	}

	printf("\n");

	return;
}

//清空
void clear(PSTACK pS)
{
	if (is_empty(pS))
		return;

	// 定义两个指针，p 指向 pTop , q 指向 p 的下一位。
	PNODE p = pS->pTop;
	PNODE q;

	while (p != pS->pBottom)
	{
		q = p->pNext;
		free(p);
		p = q;
	}

	//最终：pTop and pBottom 指向头结点
	pS->pTop = pS->pBottom;
	return;
}


