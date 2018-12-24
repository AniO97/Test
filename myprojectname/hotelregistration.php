<?php include('server.php') ?>



<!DOCTYPE html>
<html>
<head>
	<title>Hotel registration </title>
	<link href='https://yourwebsite.com/css/style.css' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="header">
		<h2>Register Hotel</h2>
	</div>
	
	<form method="post" action="hotelregistration.php" onsubmit="return vs">

		<?php include('errors.php'); ?>

		
        <p>
			<a href="login.php">Home</a>
		</p>

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
    <p>Welcome</p>
	<label name="username"  value= <strong><?php echo $_SESSION['username']; ?> </strong> </label>

    
<?php endif ?>
</div>


		<div class="input-group">
			<label id="hname">hotelname</label>
			<input type="text" name="hotelname" value="<?php echo $hotelname; ?>">
		</div>
	<!--This is a comment. type email helps in validation-->
		
    <div class="input-group">
			<label>location</label>
			<input type="text" name="location" >
		</div>

        <div class="input-group">
			<label>stars</label>
			<input type="text" name="stars" >
		</div>        

        <div>
		<input type="radio" name="premium" value="1" required>Premium
        <input type="radio" name="premium" value="0" required>Not Premium

		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="reghotel" id='validate'>Register</button>
		

			<p>
		 <a href="ownermain.php">Return to home page</a> </p>
		
	</form>
	<h3 id='result'></h3>
	<script src="signup.js"></script>
</body>
</html>