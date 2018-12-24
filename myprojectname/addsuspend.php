<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Add  Suspended Hotels</h2>
	</div>
	
	<form method="post" action="addsuspend.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Hotel name to suspend</label>
			<input type="text" name="addsuspendhotel" >
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="addsuspend">Add</button>
		</div>

		<p>
		 <a href="brokermain.php">Return to home page</a> </p>
		
	</form>


</body>
</html>