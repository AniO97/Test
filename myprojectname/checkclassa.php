<?php include('server2.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Check Customer ClassA</h2>
	</div>
	
	<form method="post" action="checkclassa.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Customer name to check </label>
			<input type="text" name="customer" >
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="checkclassa">Add</button>
		</div>

		
		
	</form>

	<a href="ownermain.php"> return to main</a> </p>
</body>

</html>