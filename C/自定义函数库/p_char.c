/*打印某个字符i行j列*/
void p_char(char ch,int i,int j)
{
	int count,calc;
	for(count=1;count<=i;count++)
	{
		for(calc=1;calc<=j;calc++)
			putchar(ch);
		putchar('\n');
	}
}