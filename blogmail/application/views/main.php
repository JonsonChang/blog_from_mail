<?php 
ini_set('display_errors', 1);
error_reporting(~0);
include 'header.php';

?>

	  <div class="row-fluid" id="users_list">
	  <div class="span12">
            <form name="formname" id="formname" method="POST" action="<?=site_url();?>/welcome/insertArticle">
            網站數量 <input name="limited" type="text" value="10"/> 不填代表全部，不能填0<br />
            標題名稱 <input name="subject" type="text" />
			<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="80">
			</textarea>
            <button id="editor_btm">送出</button>
            </form>
	  </div>
	  </div>


  
<?php include 'footer.php';?>