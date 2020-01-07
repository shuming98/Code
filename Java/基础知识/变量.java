1.变量声明,与C相似,有 String 类型
2.引用变量
例子：
	class Dog{
		String name;
	}

	public static void main(String[] args){
		Dog myDog = new Dog();     //创建对象
		Dog[] myDogs = new Dog[3]; //创建对象数组

		myDogs[0] = new Dog();
		myDogs[1] = new Dog();
		myDogs[2] = new Dog();

		myDogs[0].name="Peter";

		int x = 0;
		while(x<3){
			myDogs[x] = new Dog();
			myDogs[x].name=x;
			x++;
		}

		myDogs[2] = myDogs[0];  //引用变量
		myDogs[0] = myDogs[1];
	}