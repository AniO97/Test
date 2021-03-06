<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head>
<body>
	<div class="header">
		<h2>HomePage</h2>
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
		<?php  if (isset($_SESSION['username'])) : ?>
		<p>  <strong><?php	echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($_SESSION['image'] ).'" height="100" width="100" class="img-thumnail" />  
                               </td>  
                          </tr>  
                     ';  ?></strong></p>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: yellow;">logout</a> </p>

            <p>
			Want to register hotel? <a href="hotelregistration.php">Hotel Registeration</a> </p>

			<p>
Want to add room(s)? <a href="addrooms.php">Add</a> </p>

<a href="hotelcheckcurrent.php">check current visits</a> </p>
<a href="hotelcheckprevious.php">check previous visits</a> </p>
<a href="hotelcheckin.php">check  check-ins</a> </p>
<a href="hotelcheckout.php">check check-outs</a> </p>

<a href="addblacklist.php">Add a customer to blacklist</a> </p>
<a href="checkclassa.php">check a class A  customer</a> </p>

<a href="approvevisit.php">Approve  new visits</a> </p>
<a href="appear.php">customer appeared??</a> </p>

		<?php endif ?>
	</div>



</body>
</html>
