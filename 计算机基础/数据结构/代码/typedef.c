#include <stdio.h>

//typedef 给数据类型起别名
typedef int INT32;

//应用于构造体
//typedef struct Student ST;
typedef struct Student
{
	int sid;
	char name[50];
	char sex;
}* PST, ST;

//PST 表示 Struct Student * , ST 表示 Struct Student

int main(void)
{
	INT32 i = 6;

	ST st;
	PST pst = &st;
	pst->sid = 99;

	printf("%d\n", st.sid);

	return 0;
}