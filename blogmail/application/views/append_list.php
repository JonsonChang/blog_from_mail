<?php include 'header.php';?>
      
	  <div class="row-fluid">
		<div class="span4">
		</div>
		<div class="span4">
			<?php echo $pagination; ?>
		</div>
		<div class="span4">
		</div>
	  </div>

	  <div class="row-fluid" id="users_list">
	  <div class="span1">
	  </div>
		<div class="span11">
				<table class="table">
				  <thead>
					<tr>
					  <th>#</th>
					
					  <th>內容</th>
					
					
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($append_list as $append): ?>	 
					<tr>
					  <td><?= $append['id']; ?></td>
					  <td><?= $append['append']; ?></td>
					  <td>
						<p>##</p>
					  </td>
					</tr>
					<?php endforeach ?>	
				  </tbody>
				</table> 
		</div>
	  </div>
	  
	  <div class="row-fluid">
		<div class="span4">
		</div>
		<div class="span4">
			<?php echo $pagination; ?>
		</div>
		<div class="span4">
		</div>
	  </div>
  
<?php include 'footer.php';?>