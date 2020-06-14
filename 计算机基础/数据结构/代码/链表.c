# include <stdio.h>
# include <malloc.h>
# include <stdlib.h>

typedef struct Node
{
	int data; //数据域
	struct Node * pNext; //指针域

}NODE, * PNODE;

PNODE create_list(void);
void traverse_list(PNODE pHead);
bool is_empty(PNODE pHead);
int length_list(PNODE pHead);
void sort_list(PNODE pHead);
bool insert_list(PNODE pHead, int pos, int val);
bool delete_list(PNODE pHead, int pos, int *val);

int main(void)
{
	PNODE pHead = NULL;
	int  val;


	pHead = create_list();
	traverse_list(pHead);

	if (is_empty(pHead))
		printf("链表为空\n");
	else
		printf("链表不为空\n");

	int length = length_list(pHead);
	printf("链表长度为：%d\n", length);

	sort_list(pHead);
	traverse_list(pHead);

	insert_list(pHead, 4, 12);
	traverse_list(pHead);

	if (delete_list(pHead, 1, &val))
		printf("结点删除成功,删除的元素是 %d \n", val);
	else
		printf("结点删除失败!\n");

	traverse_list(pHead);




	return 0;
}

//创建链表
//尾插入法
PNODE create_list(void)
{
	int len; //链表长度
	int i;
	int val; //输入的有效数据

	//生成头结点
	PNODE pHead = (PNODE)malloc(sizeof(NODE));

	if (pHead == NULL)
	{
		printf("链表分配头结点内存失败！\n");
		exit(-1);
	}

	//尾结点指向头结点, 之后对尾结点进行操作
	PNODE pTail = pHead;
	pTail->pNext = NULL;


	//请用户输入链表个数
	printf("请输出链表的长度:len = ");
	scanf("%d", &len);

	//循环输入值
	for (i = 0; i < len; i++)
	{
		printf("请输入链表第 %d 个值：", i + 1);
		scanf("%d", &val);

		//生成临时结点
		PNODE pNew = (PNODE)malloc(sizeof(NODE));

		if (pNew == NULL) {
			printf("链表分配结点内存失败！\n");
			exit(-1);
		}

		//新结点最终效果，尾结点指向新结点
		pNew->data = val;
		pTail->pNext = pNew;
		pNew->pNext = NULL;
		pTail = pNew;
	}

	return pHead;
}


//遍历链表
void traverse_list(PNODE pHead)
{
	//创建一个p指针指向第一个有效元素
	PNODE p = pHead->pNext;

	printf("该链表数据如下：");

	while (NULL != p)
	{
		printf("%d ", p->data);
		p = p->pNext;
	}

	printf("\n");

	return;
}

//判断链表是否为空
bool is_empty(PNODE pHead)
{
	if (NULL == pHead->pNext)
		return true;
	else
		return false;
}


//链表长度
int length_list(PNODE pHead)
{
	PNODE p = pHead->pNext;
	int len = 0;

	while (NULL != p)
	{
		len++;
		p = p->pNext;
	}

	return len;
}

//链表排序
//理解泛型
void sort_list(PNODE pHead)
{
	int i, j, temp;

	int len = length_list(pHead);

	//定义两个指针指向两个数
	PNODE p, q;

	for (i=0, p=pHead->pNext; i<len-1; i++, p=p->pNext)
	{
		for (j=i+1, q=p->pNext; j<len; j++, q=q->pNext)
		{
			if (p->data > q->data)
			{
				temp = q->data;
				q->data = p->data;
				p->data = temp;
			}
		}
	}

	return;
}

//插入结点
//pos 从 1 开始
//在指针 p 所指向结点后面，插入一个 q 节点
//p 指向 q , q 指向 之前 p->pNext
bool insert_list(PNODE pHead, int pos, int val)
{
	int i = 0; //下标位置
	PNODE p = pHead;

	// 遍历, 找到下标对应的结点
	while (NULL != p && i < pos-1)
	{
		p = p->pNext;
		i++;
	}

	// 排错
	if (p == NULL && i > pos-1)
		return false;

	// 为新结点分配内存，并插入
	PNODE pNew = (PNODE)malloc(sizeof(NODE));
	if (NULL == pNew)
	{
		printf("动态分配内存失败！\n");
		exit(-1);
	}

	// 插入结点
	pNew->data = val;
	PNODE q = p->pNext;
	p->pNext = pNew;
	pNew->pNext = q;

	return true;
}

//删除结点
//删除指针 p 所指向结点的后一个 q 结点
bool delete_list(PNODE pHead, int pos, int * val)
{
	int i = 0;
	PNODE p = pHead;

	// 遍历
	while (NULL != p && i < pos-1)
	{
		p = p->pNext;
		i++;
	}

	if (NULL == p && i > pos-1)
		return false;

	// 删除结点
	PNODE q = p->pNext;
	*val = q->data;

	p->pNext = p->pNext->pNext;
	free(q);
	q = NULL;

	return true;
}
