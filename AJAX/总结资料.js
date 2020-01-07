1.发送post表单
$("form").submit(function(){
	$.post('url',$("form").serialize(),function(res){
		//Code...
	});
	return false;
});

2.发送get表单
$("form").bind('click/submit',function(){
	$.get('url',$("form").serialize(),function(res){
		//Code...
	});
	return false;
});

3.嵌套函数提交表单
$("button").click(function(event){
	var that =this; //!
	$("form_div").css("display","block");
	$("form").unbind('submit').submit(function(){ //!
		$.post('url',$("form").serialize(),function(res){
			alert(res);
			location.reload();
		});
	});
	return false;
});


4.上传文件
$("form").submit(function(){
var form_data = new FormData($("form")[0]);
  $.ajax({
        url: "url",
        type: "post",
        data: form_data,
        processData: false,
        contentType: false,
        xhr:xhrOnProgress(function(e){
            var percent=100*e.loaded / e.total;
            $("#upload_progress").css('width',percent+'%');//div
              $("#upload_rate").text(Math.ceil(percent)+'%');//span
          }),//文件上传进度条
        success:function(data){
            alert(data);
        },
        error:function(data){
            alert(data);
        }
    });
  return false;
});

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