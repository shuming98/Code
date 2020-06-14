//malloc动态分配，可以跨函数使用内存。
//动态malloc分配的内存，必须手动free释放


#include <stdio.h>
#include <malloc.h>

//跨函数使用内存

// void f(int ** p);

// int main(void)
// {
// 	int * i;

// 	f(&i);
// 	printf("%d %p\n", *i, i);

// 	return 0;
// }


// void f(int ** p)
// {
// 	*p = (int *)malloc(sizeof(int));
// 	**p = 3;
// }

struct Student * createList(void);
void showList(struct Student * pst);


struct Student
{
	int sid;
	int age;
};

int main(void)
{
	struct Student * st;

	//跨函数使用内存
	st = createList();
	showList(st);

	return 0;
}

struct Student * createList(void)
{
	struct Student * p = (struct Student *)malloc(sizeof(struct Student));

	p->sid = 99;
	p->age = 36;

	return p;
}

void showList(struct Student * pst)
{
	printf("%d %d\n", pst->sid, pst->age);
}