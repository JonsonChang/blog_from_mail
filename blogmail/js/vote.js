function show_dialog(msg){
	$("#message").html(msg);
	$("#dialog" ).dialog();
}

function submitform(form){
	var data;
	
	data = $('#reg_form').serialize()
	console.log(data);
	$.ajax({
            url: $("#reg_form").prop("action"),
            type: 'post',
            dataType: 'json',
            success: function (data) {
				console.log(data);
				if(data.result==1)
					show_dialog("今天已投過票了");
				else if(data.result==2)
					show_dialog("票券號碼已使用");
				else if(data.result==0)
					show_dialog("投票成功");
				else
					show_dialog("錯誤");
            },
            data: data
        });
	
}

$(function() {
	var action_url= base_url + "index.php/vote/do_voting";
	$("#reg_form").prop("action",action_url);
	
	$("#do_vote").click(function(){$("#reg_form").submit();});

	$("#reg_form").validate({
		debug: true,
		 rules: {
			uname:{
				required:true
			},
			phone:{
				required:true,
				digits:true
			},
			address:{
				required:true
			},
			email: {
				required: true,
				email: true
			},
			id:{
				required: true
			}			
		 },
		submitHandler: submitform
		
	});

 }); 