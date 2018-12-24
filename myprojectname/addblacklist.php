<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Add  Blacklist</h2>
	</div>
	
	<form method="post" action="addblacklist.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Customer name to blacklist</label>
			<input type="text" name="addblacklistuser" >
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="addblacklist">Add</button>
		</div>

		
		
	</form>

	<a href="ownermain.php">Add a customer to blacklist</a> </p>
</body>

</html>