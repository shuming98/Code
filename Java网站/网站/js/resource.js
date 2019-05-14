/**
 * Jquery
 */
//绑定xhr.upload.onprogress监听事件
var xhrOnProgress=function(fun) {
  xhrOnProgress.onprogress = fun; 
  return function() {
    var xhr = $.ajaxSettings.xhr();
    if (typeof xhrOnProgress.onprogress !== 'function')
      return xhr;
    if (xhrOnProgress.onprogress && xhr.upload) {
      xhr.upload.onprogress = xhrOnProgress.onprogress;
    }
    return xhr;
  }
}

//ajax上传资源表单
   $("#upload_resource_form").submit(function(){
  var form_data = new FormData($("#upload_resource_form")[0]);
      $.ajax({
            url: "../admin/upload_resource.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            xhr:xhrOnProgress(function(e){
                var percent=100*e.loaded / e.total;
                $("#upload_progress").css('width',percent+'%');
                  $("#upload_rate").text(Math.ceil(percent)+'%');
              }),
            success:function(data){
                alert(data);
            },
            error:function(data){
                alert(data);
            }
        });
      return false;
    });

//ajax添加资源分类标签
  $("#add_tag form").submit(function(){
  var data={'tag_name':$("#add_tag input[name='tag_name']").val()};
  $.post('../admin/add_tag.php',data,function(res){
    alert(res);
    $("#add_tag").css('display','none');
    location.reload();
  });
  return false;
});

/**
 * 匿名函数
 */

//打开|关闭上传资源模态框
document.getElementById('up_res_btn').onclick = function(){
  document.getElementById('upload_resource').style.display = "block";
}

document.getElementById('up_res_close').onclick = function(){
  document.getElementById('upload_resource').style.display = "none";
}

//打开|关闭添加分类模态框
document.getElementById('add_tag_btn').onclick = function(){
  document.getElementById('add_tag').style.display = "block";
}

document.getElementById('add_tag_close').onclick = function(){
  document.getElementById('add_tag').style.display = "none";
}

//ajax统计下载次数
$(".one_resource").bind('click',function(event){
  $.get('../admin/count_download.php?resource_id='+event.target.getAttribute("data-rid"),function(data){
  });
});