对象所知者是实例变量
对象所为者是方法
1.private 变量,public 方法
 例:
 	class PoorDog{
 		private int size;
 		private String name;

 		public int getSize(){
 			return size;
 		}

 		public void setSize(int size){
 			size = size;
 		}
 	}

 	PoorDog dog = new PoorDog();
 	dog.size=20; //不能这么干
 	dog.setSize(20); //转化为这么干
 	dog.getSize();

 	int std;
 	std = 30 + getSize();