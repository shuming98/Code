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

//ajax发布作业
$("#issue_work").submit(function(){
var form_data = new FormData($("#issue_work")[0]);
  $.ajax({
        url: "../admin/issue_work.php",
        type: "post",
        data: form_data,
        processData: false,
        contentType: false,
        success:function(data){
            alert(data);
        },
        error:function(data){
            alert('发布失败');
        }
    });
  return false;
});