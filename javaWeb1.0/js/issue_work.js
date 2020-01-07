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