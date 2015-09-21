var aa;
function show_dialog(msg){
	$("#message").html(msg);
	$("#dialog" ).dialog();
}
function click_who_vote(e)
{
	var id = $(this).attr("competitors_id");
	var url = site_url+"/admin/who_voter_list/"+id;
	window.location=url;
}

function click_del_vote(e)
{
	var ip = $(this).attr("ip");
	var date = $(this).attr("date");
	
	$("#message").html("確定要刪除嗎？\n");
	$("#dialog").dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        "確定": function() {
			var url = site_url+"/admin/del_vote/"+ip + "/"+date;
			console.log(url);
			//return;
			$.get(url)
				.success(function(){window.location=window.location;})
				.error(function(){console.log("error");window.location=site_url+"/admin/competitors_list/";});

          $( this ).dialog( "close" );
        },
        "取消": function() {
          $( this ).dialog( "close" );
        }
      }
    });	
	
}

function click_delete_competitors(e)
{
	var id = $(this).attr("competitors_id");
	$("#message").html("確定要刪除#"+id+"嗎？\n");
	$("#dialog").dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        "確定": function() {
			var url = site_url+"/admin/del_competitors/"+id;
			console.log(url);
			$.get(url)
				.success(function(){window.location=site_url+"/admin/competitors_list/";})
				.error(function(){console.log("error");window.location=site_url+"/admin/competitors_list/";});
			
			
          $( this ).dialog( "close" );
        },
        "取消": function() {
          $( this ).dialog( "close" );
        }
      }
    });	
	console.log(id);
}

$(function() {

	$('[id=del]').click(click_delete_competitors);
	$('[id=voter]').click(click_who_vote);
	$('[id=del_vote]').click(click_del_vote);
	
	console.log(del);


 }); 