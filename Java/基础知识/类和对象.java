例：
class Dog{              //类
	int size;           //实例变量,属性
	String breed;
	String name;

	void bark(){        //方法,行为
		System.out.println("Ruff!Ruff!");
	}
}

class DogTestDrive{
	void static void main (String[] args){
		Dog d = new Dog();  //创建对象   [类名 对象名=new类名()]
		d.size = 20;          //操作属性
		d.bark();           //操作方法
	}
}

1.类有属性和方法;
2.创建对象:类名 对象名 = new 类型();
3.在主函数内创建和操作对象的属性和方法: [对象名.属性] [对象名.方法];