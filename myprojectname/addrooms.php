<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add you room</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="style.css">
           
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
  <div class="header">
  	<h2>Add your room</h2>
  </div>

  <form method="post" action="addrooms.php"  enctype="multipart/form-data">
  	<?php include('errors.php'); ?>


  	  <label>Room type</label>
  	  <select name="roomtype">
      <option>---type--</option>
      <option value="single">single</option>
      <option value="double">double</option>
      <option value="king">king</option>
      <option value="queen">Queen</option>
      <option value="Triple">Triple</option>

      </select>


     <div class="input-group">
  	  <label>Price</label>
  	  <input type="number"  name="price">
  	</div>

    <div class="input-group">
      <label id="facilities">Facilities</label>
      <input type="text" name="facilities" >
    </div>

    <div class="input-group">
			<label id="count">Count</label>
			<input type="text" name="count" >
		</div>

    <div class="input-group">
			<label id="count">Add image</label> 
			<input type="file" name="image" id="image" /> 
		</div>

  	<div class="input-group">
  	  <button type="submit" class="btn"  id="insert" name="addroom">Add Room</button>
  	</div>


    <p>
		 <a href="ownermain.php">Return to home page</a> </p>

  </form>
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
