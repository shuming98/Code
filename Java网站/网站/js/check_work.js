//历史记录侧边栏
function openSide(){
  var side = document.getElementById("side_content");
    if(side.style.width === "0px"){
      side.style.width = "300px";
  }else{
    side.style.width = "0px";
  }
}

$(".check_from").submit(function(){
  var that = this;
  $.post('../admin/check_work.php?user_account='+$(that).data('account')+'&work_id='+$(that).data('workid'),$(that).serialize(),function(res){
    alert(res);
    location.reload();
  });
  return false;
 });