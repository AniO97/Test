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
		<h2>Removal from supsend list is successful</h2>
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
		<?php  if (isset($_SESSION['removesuspendhotel'])) : ?>
			<p>Remove Suspend <strong><?php echo $_SESSION['removesuspendhotel']; ?></strong></p>
			<p> <a href="brokermain.php" style="color: yellow;">Return to main</a> </p>
		<?php endif ?>
	</div>

</body>
</html>
