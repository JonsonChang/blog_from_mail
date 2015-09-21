function show_dialog(msg){
	$("#message").html(msg);
	$("#dialog" ).dialog();
}

function submitform(form){
	
	if($("#img_name_0").prop("value")==""){
		show_dialog("請選擇相片檔案");
		return;
	}
	console.log("submit");
	form.submit();
}

function show_uploaded_img(index,filename)
{
	var img_id = "#img"+index;
	var img_path = base_url +"/timthumb/timthumb.php?src="+base_url +"upload_photo/"+ filename +"&h=90&zc=1";
	$(img_id).attr("src",img_path).show();
	
	var img_name = "#img_name_"+index;
	$(img_name).prop("value",filename);

}

$(function() {

	for(i=0;i<1;i=i+1){
		img_id = "#img"+i;
		$(img_id).hide();
	}

	var swf =  base_url+'uploadify.swf';
	var uploader =  base_url+'index.php/vote/do_upload_img';


	$('#file_upload').uploadify({
		'uploadLimit': 1,
		'buttonText' : '選擇檔案',
		'swf'      : swf,
		'uploader' : uploader,
		'fileSizeLimit' : '1MB',
		'fileTypeDesc' : 'Image Files',
        'fileTypeExts' : '*.gif; *.jpg; *.png',		
		'onUploadSuccess' : function(file, data, response) {
			console.log(file.index);
			console.log(data);
			//console.log(response);
			show_uploaded_img(file.index, data);
		}
	});

	$("#reg_form").validate({
		debug: true,
		 rules: {
			nick:{
				required:true
			},
			username:{
				required:true
			},
			book_id:{
				required:true
			},
			address:{
				required:true
			},
			describe:{
				required:true
			},
			phone:{
				required:true,
				digits:true
			},
			email: {
				required: true,
				email: true
			}
		 },
		submitHandler: submitform
	});

 }); 