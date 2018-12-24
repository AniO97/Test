<?php 
	session_start(); 

	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>checking  classA successfully</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['customerclassa'])) : ?>
			<p> <strong><?php echo $_SESSION['customerclassa']; ?>  </strong></p>

			<p><a href="ownermain.php">Return to home page</a> </p>
			<p> <a href="index.php?logout='1'" style="color: yellow;">logout</a> </p>
		<?php endif ?>

       
	</div>
		
</body>
</html>