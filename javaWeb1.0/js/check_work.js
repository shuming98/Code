//历史记录侧边栏
function openSide(){
  if($("#side_content").css('width') === '0px'){
    $("#side_content").css('width','300px');
  }else{
    $("#side_content").css('width','0px');
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