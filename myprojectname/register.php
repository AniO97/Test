<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>User registration </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
	<div class="header">
		<h2>Register User</h2>
	</div>
	
	<form method="post" action="register.php"    onsubmit="return vs"     enctype="multipart/form-data" >

		<?php include('errors.php'); ?>

		


		<div class="input-group">
			<label id="username">Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label id="fname">Fitst name</label>
			<input type="text" name="fname" >
		</div>
		<div class="input-group">
			<label id="lastname">Last name</label>
			<input type="text" name="lname" >
		</div>
	<!--This is a comment. type email helps in validation-->
	<div class="input-group">
			<label id="email">Email</label>
			<input id='email' type="email" name="email" value="<?php echo $email; ?>">   
		</div>
		
		<div class="input-group">
			<label id="pass">Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label id="pass1">Confirm password</label>
			<input type="password" name="password_2">
		</div>

		<div >
			<label id="count">Add image</label> 
			<input type="file" name="image" id="image" /> 
		</div>

		<div>
		<input type="radio" name="usertype" value="c" required>Customer
        <input type="radio" name="usertype" value="o" required>Hotel Owner 

		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="reg_user" id='validate'>Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
	<h3 id='result'></h3>
	<script src="signup.js"></script>
</body>
</html>

<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  