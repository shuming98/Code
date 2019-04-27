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

//历史记录侧边栏
function openSide(){
  var side = document.getElementById("side_content");
    if(side.style.width === "0px"){
      side.style.width = "300px";
  }else{
    side.style.width = "0px";
  }
}