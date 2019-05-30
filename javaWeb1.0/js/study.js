/*树目录*/
var toggler = document.getElementsByClassName("caret");
var i;
for(i=0;i<toggler.length;i++){
  toggler[i].addEventListener("click",function(){
	  this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret_down");
  });
}

//ajax添加父节点名
  $("#add_dir form").submit(function(){
  var data={'dirname':$("#add_dir input[name='dirname']").val()};
  $.post('../admin/add_dir.php',data,function(res){
    alert(res);
    $("#add_dir").css('display','none');
    location.reload();
  });
  return false;
});

/**
 * 匿名函数
 */

/*点击打开添加目录-模态框*/
document.getElementById('add_dir_button').onclick = function(){
	document.getElementById('add_dir').style.display = "block";
}

/*点击关闭添加目录-模态框*/
document.getElementById('add_dir_close').onclick = function(){
	document.getElementById('add_dir').style.display = "none";
}