<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Remove Suspended Hotels</h2>
	</div>

	<form method="post" action="removesuspend.php">

		<?php include('errors.php'); ?>

    <p>
    <a href="brokermain.php">Home</a>
    </p>

		<div class="input-group">
			<label>Hotel name to remove from suspended list</label>
			<input type="text" name="removesuspendhotel" >
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="removesuspend">Add</button>
		</div>



	</form>


</body>
</html>
