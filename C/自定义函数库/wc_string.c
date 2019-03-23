#include <stdio.h>
#include <string.h>
#include <ctype.h>
int main(void){
	char str[256];
	int word_num=0;
	int upper_num=0;
	int lower_num=0;
	int sign_num=0;
	int digit_num=0;
	char ch;

	printf("please enter a string:");
	fgets(str,256,stdin);
	int length = strlen(str);
	for(int i=0;i<=length;i++)
	{
		if(isspace(str[i]) || '\0' == str[i])
			word_num++;
		else if(isupper(str[i]))
			upper_num++;
		else if(islower(str[i]))
			lower_num++;
		else if(ispunct(str[i]))
			sign_num++;
		else if(isdigit(str[i]))
			digit_num++;
	}
	printf("string:%s\nisword:%d\nisupper:%d\nislower:%d\nissign:%d\nisdigit:%d\n",str,word_num,upper_num,lower_num,sign_num,digit_num);
	return 0;
}