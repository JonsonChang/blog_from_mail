<?php 
ini_set('display_errors', 1);
error_reporting(~0);
include 'header.php';

?>

	  <div class="row-fluid" id="users_list">
	  <div class="span12">
            新增法語：
            <form name="formname" id="formname" method="POST" action="<?=site_url();?>/welcome/do_add_append">
			<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="80">
            <p></p>
            <p>~悟覺妙天禪師禪修語錄~</p>
            <p><a href="http://www.ymchancntr.com/" style="line-height: 1.6em;">財團法人釋迦牟尼佛救世基金會-中壢禪修會館</a><span style="line-height:1.6em">&nbsp;</span><a href="http://www.ymchancntr.com/" style="line-height: 1.6em;">http://www.ymchancntr.com/</a></p>
            
			</textarea>
            <button id="editor_btm">送出</button>
            </form>
	  </div>
	  </div>


  
<?php include 'footer.php';?>