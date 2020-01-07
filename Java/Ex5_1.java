import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
public class Ex5_1 extends JFrame implements ActionListener{ 
JTextField text;                                        
  JLabel    str;                         
  JButton  buttonEnter,buttonQuit;
     Ex5_1()
 {
  setBounds(100,100,300,200);           
    setVisible(true);                                  
    setLayout(newFlowLayout());                           setDefaultCloseOperation(EXIT_ON_CLOSE);    
    str=new JLabel("在文本框输入数字字符回车或单击按钮");    
  add(str);                                                                                                                                
    text=new JTextField("0",10);                       
    add(text);
    buttonEnter =new JButton("确定");                    
    buttonQuit  =new JButton("清除");                    
    add(buttonEnter);add(buttonQuit);
    validate();
    buttonEnter.addActionListener(this);
    buttonQuit.addActionListener(this);                      
    text.addActionListener(this);
    }
   public void actionPerformed(ActionEvent e)
   { if(e.getSource()==buttonEnter||e.getSource()==text)
     {double num=0;
       try {  num=Double.valueOf(text.getText()).doubleValue();
          text.setText(""+Math.sqrt(num));                   
          }
       catch(NumberFormatException event)
      {   text.setText("请输入数字字符");
      }
    }
      else if(e.getSource()==buttonQuit)
      {text.setText("0");
      }
    }       
   public static void main(String[] args)
  {new Ex5_1(); }
}
