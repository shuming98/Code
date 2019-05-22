/**
 * 发布作业_日期选择器
 */
function YYYYMMDDstart() {
     MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

     //赋值年下拉框内容   
     var y = new Date().getFullYear();
     //for (var i = y; i < (y + 1); i++) 
         document.work_date.YYYY.options.add(new Option(" " + y + " 年", y));

     //赋值月下拉框   
     for (var i = 1; i < 13; i++)
         document.work_date.MM.options.add(new Option(" " + i + " 月", i));

     document.work_date.YYYY.value = y;
     document.work_date.MM.value = new Date().getMonth() + 1;
     var n = MonHead[new Date().getMonth()];
     if (new Date().getMonth() == 1 && IsPinYear(YYYYvalue)) n++;
     writeDay(n); //赋日期下拉框  
     document.work_date.DD.value = new Date().getDate();
 }
 if (document.attachEvent)
     window.attachEvent("onload", YYYYMMDDstart);
 else
     window.addEventListener('load', YYYYMMDDstart, false);

//年发生变化时日期发生变化(主要是判断闰平年)
 function YYYYDD(str)    
 {
     var MMvalue = document.work_date.MM.options[document.work_date.MM.selectedIndex].value;
     if (MMvalue == "") {
         var e = document.work_date.DD;
         optionsClear(e);
         return;
     }
     var n = MonHead[MMvalue - 1];
     if (MMvalue == 2 && IsPinYear(str)) n++;
     writeDay(n)
 }

 //月发生变化时日期联动
 function MMDD(str)   
 {
     var YYYYvalue = document.work_date.YYYY.options[document.work_date.YYYY.selectedIndex].value;
     if (YYYYvalue == "") {
         var e = document.work_date.DD;
         optionsClear(e);
         return;
     }
     var n = MonHead[str - 1];
     if (str == 2 && IsPinYear(YYYYvalue)) n++;
     writeDay(n)
 }

//据条件写日期的下拉框  
 function writeDay(n)  
 {
     var e = document.work_date.DD;
     optionsClear(e);
     for (var i = 1; i < (n + 1); i++)
         e.options.add(new Option(" " + i + " 日", i));
 }
 
//判断是否闰平年 
 function IsPinYear(year)   
 {
     return (0 == year % 4 && (year % 100 != 0 || year % 400 == 0));
 }

 function optionsClear(e) {
     e.options.length = 1;
 }

//显示当前时间
var timer=null;
function displayClock(num){
  if(num<10){
    return "0"+num;
  }
  else{
    return num;
  }
}
//停止计时
function stopClock(){
  clearTimeout(timer);
}
//开始计时
function startClock(){
  var time =new Date();
  var hours=displayClock(time.getHours())+":";
  var minutes=displayClock(time.getMinutes())+":";
  var seconds=displayClock(time.getSeconds());
  //显示时间
  show_time.innerHTML=hours+minutes+seconds;
  timer=setTimeout("startClock()",1000);
}

window.onload = startClock();

