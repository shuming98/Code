#include <stdio.h>
#include <string.h>
char * s_gets(char * st,int n);
void invert(char * str);  //识别不了中文字符
//void ch(char c);
int main(void)
{
	char str[255];
	while(1){
	printf("please enter a string:");
	s_gets(str,255);
	invert(str);
}
	return 0;
}

void invert(char * str)
{
	char ch;
	int str_length = strlen(str);
	for(int i=0;i<str_length/2;i++)
	{
		ch = str[i];
		str[i] = str[str_length-i-1];
		str[str_length-i-1] = ch;
	}
	for(int i=0;i<str_length;i++)
		printf("%c ",str[i]);
	printf("\n");
}

/*递归法
int main()
{
	ch(getchar());
	putchar('\n');
	return 0;

}
void ch(char c)
{
	if(c !='\n'){
		ch(getchar());
		putchar(c);
	}
}*/

char * s_gets(char * st,int n)
{
	char * ret_val;
	int i=0;

	ret_val = fgets(st,n,stdin);
	if(ret_val)
	{
		while(st[i] !='\n' && st[i] !='\0')
			i++;
		if(st[i] == '\n')
			st[i] = '\0';
		else
			while (getchar() != '\n')
				continue;
	}
	return ret_val;
}