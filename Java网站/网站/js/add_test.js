var num=1;
	//添加选择题表单
	$("#add_choice").click(function(){
		num++;
		var text = '<div class="add_choice_temp"><p>'+num+'.<input type="text" name="q[]" required="required"></p><p class="choice_answer">A.<input type="text" name="A[]" required="required">B.<input type="text" name="B[]" required="required">C.<input type="text" name="C[]" required="required">D.<input type="text" name="D[]" required="required">答案:<select name="res[]"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select></p></div>';
		$(".add_content").append(text);
		$("#add_count").text("你已添加"+num+"道选择题表单");
	});

	//删除选择题表单
	$("#minus_choice").click(function(){
		num--;
		if(num<0){
			return num=0;
		}
		$(".add_choice_temp:last-child").remove();
		$("#add_count").text("你已添加"+num+"道选择题表单")
	});