<?php
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$userid ="";
	$hotelname ="";
	$hotelid="";
	$errors = array();
	$_SESSION['success'] = "";
	$location="";
	$stars="";
	$premium="";
	$blacklist="";
	$lname="";
	$fname="";
	$image="";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'brokerdb');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);



		$fname = $_POST['fname'];
		$lname = $_POST['lname'];

		$type = $_POST['usertype'];


		if(isset($_FILES['image'])){
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		}

		// form validation: ensure that the form is correctly filled

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($fname)) { array_push($errors, "Your firt name is required"); }
		if (empty($lname)) { array_push($errors, "Your last name is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
//to check that the  user id wasnot present before
		if (count($errors) == 0) {
			if($type=="c")
            {

			$query = "SELECT * FROM customer WHERE username='$username'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 0) {

			}
			else {
				array_push($errors, " username already used");
            }
		}

		else{
			$query = "SELECT * FROM owner WHERE username='$username'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 0) {

			}
			else {
				array_push($errors, " username already used");
			}

		}


		}


		//test emaili s in email form

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, " emaail not inform");
			}





		// add  user to 'users' tabel if there are no errors in the form
		if (count($errors) == 0) {


			if($type=="c")
            {
			$password = md5($password_1);//encrypt the password for security and hacker
			$query = "INSERT INTO customer (username,  password,email,fname,lname,image)
					  VALUES('$username',  '$password','$email','$fname','$lname','$image')";
			mysqli_query($db, $query);



			$query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {

				$row = $results->fetch_assoc();

				$_SESSION['image']=$row["image"];


				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";


				header('location: mainforcustomer.php');

			}
		}
            else{ /// i insert in owner

                $password = md5($password_1);//encrypt the password for security and hacker
			$query = "INSERT INTO owner (username,  password,email,fname,lname,image)
					  VALUES('$username',  '$password','$email','$fname','$lname','$image')";
			mysqli_query($db, $query);


			$query = "SELECT * FROM owner WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";


				
				
					$row = $results->fetch_assoc();

					$_SESSION['image']=	$row["image"];

					
				header('location: ownermain.php');

				
			}
            }
		}

	}
	
	// ...

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$type = $_POST['usertype'];

		if (empty($username))
		 {
			 array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {

			if($type=="c")
			{

			$password = md5($password);
			$query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {

				$row = $results->fetch_assoc();

				$_SESSION['image']=$row["image"];


				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";


				header('location: mainforcustomer.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}

		}

		if($type=="o")
			{

			$password = md5($password);
			$query = "SELECT * FROM owner WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				$row = $results->fetch_assoc();

				$_SESSION['image']=	$row["image"];



				$query = " SELECT hotelname from hotel where username ='$username'";
				$results=	mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) {
					$row = $results->fetch_assoc();

					

				

					$hotelname= $row["hotelname"];
					$_SESSION['hotelname']= $hotelname;

				}

				

				header('location: ownermain.php');
			}else {
				array_push($errors, "Wrong userid/password combination");
			}

		}




		if($type=="b")
			{

			$password = md5($password);
			$query = "SELECT * FROM broker WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";


				header('location: brokermain.php');
			}else {
				array_push($errors, "Wrong userid/password combination");
			}

		}









		}
	}

////  resgister a  hotel
	if (isset($_POST['reghotel'])) {
		// receive all input values from the form
		$username = $_SESSION['username'];
		$hotelname = mysqli_real_escape_string($db, $_POST['hotelname']);
		$location = mysqli_real_escape_string($db, $_POST['location']);
		$stars = mysqli_real_escape_string($db, $_POST['stars']);

		$premium= $_POST['premium'];



		// form validation: ensure that the form is correctly filled

		if (empty($hotelname)) { array_push($errors, "hotelname is required"); }
		if (empty($location)) { array_push($errors, "location is required"); }
		if (empty($stars)) { array_push($errors, "stars is required"); }









		$query12 = " SELECT hotelname from hotel where username ='$username'";
				$results=	mysqli_query($db, $query12);
				if (mysqli_num_rows($results) == 1) {
					array_push($errors, " you already   registered   hotel before ");

				}


//to check that the  hotelname wasnot present before
		if (count($errors) == 0) {



			$query = "SELECT * FROM hotel WHERE hotelname='$hotelname'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 0) {

			}
			else {
				array_push($errors, " hotelname already used");
			}




		}





		// add  user to 'users' tabel if there are no errors in the form
		if (count($errors) == 0) {






			$query = "INSERT INTO hotel (username,hotelname, location,stars,premium)
			VALUES('$username','$hotelname','$location'  ,'$stars','$premium');";
			mysqli_query($db, $query);



			$_SESSION['username'] = $username;




			$_SESSION['success'] = "You are now logged in";
           header('location: ownermain.php');


		}

	}
 ////  add   hotel room

		if (isset($_POST['addroom'])) {
		  // receive all input values from the form
		  $roomtype = mysqli_real_escape_string($db, $_POST['roomtype']);
		    $price = mysqli_real_escape_string($db, $_POST['price']);
				$facilities = mysqli_real_escape_string($db, $_POST['facilities']);
				$count = mysqli_real_escape_string($db, $_POST['count']);
				$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

$username  =$_SESSION['username'];






		  // form validation: ensure that the form is correctly filled ...
		  // by adding (array_push()) corresponding error unto $errors array
		  if (empty($roomtype)) { array_push($errors, "roomtype is required"); }
		    if (empty($price)) { array_push($errors, "price is required"); }
				if (empty($facilities)) { array_push($errors, "facilities is required"); }
				if (empty($count)) { array_push($errors, "count is required"); }



				//$query2 = " SELECT type from hotelroom where username ='$username'";


					$query = " SELECT hotelname from hotel where username ='$username'";
				$results=	mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 0) {
					array_push($errors, " No hotel registered");

				}

				 else if (mysqli_num_rows($results) == 1) {
					
					$row = $results->fetch_assoc();

					$hotelname= $row["hotelname"];

					$query = " SELECT type from hotelroom where hotelname ='$hotelname' and type = '$roomtype'";
					$results=	mysqli_query($db, $query);
					if (mysqli_num_rows($results) > 0) {
						array_push($errors, " type already exist");
	
					}


					else{
					$query1 = "INSERT INTO hotelroom (hotelname, type, facilities, price, count,image)
					VALUES('$hotelname','$roomtype', '$facilities','$price', '$count','$image')";
		  mysqli_query($db, $query1);

		  $_SESSION['success'] = "You are now logged in";


		  header("location: ownermain.php");


					}

				}
				else
				{
					array_push($errors, " Many  hotel registered   by error");

				}

				if (count($errors) == 0) {

              
			  	
			     

			  	// header('location: index.php');
			  }
			}

		  //                                                                                                  ADD ROOM

//for adding    a  customer to blacklist

	if (isset($_POST['addblacklist'])) {


		$blacklist =  $_POST['addblacklistuser'];

		if (empty($blacklist)) { array_push($errors, "Customer to blacklist is required"); }



		if (count($errors) == 0) {


			$query = "SELECT * FROM customer WHERE username='$blacklist'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {

			}
			else {
				array_push($errors, " customer is not present");
            }
		}


		if (count($errors) == 0) {




			$query = "UPDATE customer set blacklist=1 where username='$blacklist'";

			mysqli_query($db, $query);

				$_SESSION['addblacklistuser'] = $blacklist;
				$_SESSION['success'] = "is  blocked";


				header('location: successblacklist.php');


		}



	}

	//for adding a hotel to suspend

	if (isset($_POST['addsuspend'])) {


		$suspend =  $_POST['addsuspendhotel'];

		if (empty($suspend)) { array_push($errors, "Hotel to suspend is required"); }



		if (count($errors) == 0) {


			$query = "SELECT * FROM hotel WHERE hotelname='$suspend'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {

			}
			else {
				array_push($errors, " hotel is not present");
            }
		}


		if (count($errors) == 0) {




			$query = "UPDATE hotel set suspend=1 where hotelname='$suspend'";

			mysqli_query($db, $query);

				$_SESSION['addsuspendhotel'] = $suspend;
				$_SESSION['success'] = "is  suspended";


				header('location:successsuspend.php');


		}



	}


if (isset($_POST['search'])) {


	$rate= $_POST['ratings'];
	$stars=$_POST['stars'];
	$roomtype=$_POST['roomtype'];
	$location= $_POST['location'];
	$price=$_POST['price'];
	 $i=1;
	 $_SESSION['sd']=$_POST['startday'];
	 $_SESSION['sm']=$_POST['startmonth'];
	 $_SESSION['sy']=$_POST['startyear'];
	 $_SESSION['ed']=$_POST['endday'];
	 $_SESSION['em']=$_POST['endmonth'];
	 $_SESSION['ey']=$_POST['endyear'];


	 $query = "SELECT  h.hotelname,hr.price,hr.facilities,h.location,hr.type,hr.image,h.stars  FROM hotel as h join hotelroom as hr on h.hotelname=hr.hotelname where price<'$price' AND  stars like'$stars'  AND location like '$location' AND type like'$roomtype' AND rating like'$rate'AND h.approved=1 AND h.suspend=0 order by h.premium desc ";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["hotelname"]. "</td><td>" . $row["price"] . "</td><td>" . $row["location"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Reserve</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";
		

echo' <!DOCTYPE html> <html> <head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head> <body> <table>';

 echo "<tr><td>" . $row["hotelname"]. "</td><td>". $row["stars"]. "</td><td>". $row["type"]. "</td><td>" . $row["price"] . "</td><td>" . $row["location"]. "</td>" ;
 echo '    <td>  <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="100" width="100" class="img-thumnail" />  </td> ';
		echo "<td><form  method=\"post\" >

  <input type=\"submit\"name=\"reserve\" value=" .$i."> RESERVE this</input>
</form> </td></tr></table> </body>";

		$i++;
}
echo "</table>";
} else { echo "0 results"; }



$_SESSION['i']=$i;

$_SESSION['ratings']= $rate;
$_SESSION['stars']=$stars;
$_SESSION['roomtype']=$roomtype;
$_SESSION['location']= $location;
$_SESSION['price']=$_POST['price'];



}



if (isset($_POST['reserve'])) {

	$i=$_POST['reserve'];
//	$result=$_SESSION['result'];
	$rate=$_SESSION['ratings'];
	$stars=$_SESSION['stars'];
	$roomtype=$_SESSION['roomtype'];
$location=	$_SESSION['location'];
$price=	$_SESSION['price'];
$username=$_SESSION['username'];
$sd= $_SESSION['sd'];
$sm= $_SESSION['sm'];
$sy= $_SESSION['sy'];
$ed= $_SESSION['ed'];
$em= $_SESSION['em'];
$ey= $_SESSION['ey'];



$x=1;


$query = "SELECT  h.hotelname,hr.price,hr.facilities,h.location,hr.type  FROM hotel as h join hotelroom as hr on h.hotelname=hr.hotelname where price<'$price' AND  stars like'$stars'  AND location like '$location' AND type like'$roomtype' AND rating like'$rate' AND h.approved=1 AND h.suspend =0  order by h.premium desc";
  $result = 	mysqli_query($db, $query);




 while($row =  $result->fetch_assoc()) {

		 if($x==$i)
		 {
			 break;
		 }
		 $x++;
	}
$hotelname=$row["hotelname"];
$type=$row["type"];

	$query = "INSERT INTO reservations (username,  hotelname,type,startdate,enddatedate)
				VALUES('$username',  '$hotelname','$type','$sy-$sm-$sd','$ey-$em-$ed') " ;
	mysqli_query($db, $query);

	$query= "SELECT * from reservations where username='$username'";
	$results=mysqli_query($db, $query);



	if ($results->num_rows >= 5) {

		$query="Update customer  set classA='1' where username='$username' ";
		mysqli_query($db, $query);

	}


}






?>
