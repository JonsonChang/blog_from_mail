<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>管理後台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="//cdnjs.bootcss.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
    </style>
    <link href="//cdnjs.bootcss.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.bootcss.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->
	<link href="<?=base_url();?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>ckeditor/samples/sample.css" rel="stylesheet" type="text/css" />
	
	<script src="<?=base_url();?>js/jquery-1.9.1.js"></script>
	<script src="<?=base_url();?>js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="//cdnjs.bootcss.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>js/jquery.form.js"></script>
	<script src="<?=base_url();?>js/jquery.validate.min.js"></script>
	<script src="<?=base_url();?>js/additional-methods.js"></script>
	<script src="<?=base_url();?>ckeditor/ckeditor.js"></script>
	<script>
		var site_url = "<?= site_url();?>";
	</script>
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="muted">管理後台</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                
                <li><a href="<?=site_url();?>">新增文章</a></li>
                <li><a href="#">新增網站</a></li>
				<li><a href="<?=site_url();?>/welcome/web_list">網站列表</a></li>
                <li><a href="<?=site_url();?>/welcome/post_blog">手動發信</a></li>
                <li><a href="<?=site_url();?>/welcome/addappend">新增法語</a></li>
                <li><a href="<?=site_url();?>/welcome/append_list">Append List</a></li>
                <li><a href="/phpMyAdmin">phpMyAdmin</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
