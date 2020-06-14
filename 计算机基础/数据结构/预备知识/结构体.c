# include <stdio.h>
# include <string.h>

//定义结构体数据类型
struct Student
{
	int sid;
	char name[200];
	int age;
};

void input(struct Student * pst);
void output(struct Student * pst);
void out(struct Student st);

// //结构体使用的两种方式
// int main(void)
// {
// 	//定义结构体变量名，并初始化
// 	struct Student st = {1, "zhangsan", 18};

// 	//赋值:第一种方式,'.'
// 	st.sid = 10;
// 	//字符串使用函数赋值
// 	strcpy(st.name, "lisi");

// 	//赋值：第二种方式，指针指向
// 	struct Student * pst = &st;
// 	pst->sid = 99; //等价于 *(pst).sid

// 	//输出
// 	printf("%d %s\n", st.sid, st.name);

// 	return 0;
// }


//使用函数传参
int main(void)
{
	struct Student st; //为结构体变量分配内存
	input(&st); //传地址修改变量
	output(&st); //传递地址输出结果更快
	//out(st); //传递变量输出结果较慢，不推荐

	return 0;
}

void input(struct Student * pst)
{
	pst->sid = 111;
	strcpy(pst->name, "xiaolong");
	pst->age = 23;
}

void output(struct Student * pst)
{
	printf("%d %s %d\n", pst->sid, pst->name, pst->age);
}

void out(struct Student st)
{
	printf("%d %s %d\n", st.sid, st.name, st.age);
}