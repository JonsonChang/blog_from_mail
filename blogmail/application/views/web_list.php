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
					  <th>URL</th>
					  <th>Email</th>
					  <th>Account</th>
					  <th>##</th>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($web_list as $web): ?>	 
					<tr>
					  <td><?= $web['id']; ?></td>
					  <td><a href="<?= $web['url']; ?>" target="_blank"><?= $web['url']; ?></a></td>
					  <td><?= $web['email']; ?></td>
					  <td><?= $web['account']; ?></td>
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