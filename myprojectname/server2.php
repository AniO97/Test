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
	$id="";
	$row="";
	$suspend='1';

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'brokerdb');


///  search non approved
if (isset($_POST['search'])) {


	$i=1;


	 $query = "Select hotelname ,username as owner from hotel where approved=0";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["hotelname"]. "</td><td>" . $row["price"] . "</td><td>" . $row["location"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Reserve</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";

	
 echo "<tr><td>" . $row["hotelname"]. "</td><td>". $row["owner"].  "</td>";
		echo "<td><form  method=\"post\">

  <input type=\"submit\"name=\"approve\" value=" .$i."> Approve this hotel</input>
</form> </td></tr>";

		$i++;
}
echo "</table>";
} else { echo "0 results"; }



$_SESSION['i']=$i;





}



if (isset($_POST['approve'])) {

	$i=$_POST['approve'];
//

	

$x=1;


$query = "Select hotelname ,username as owner from hotel where approved=0 ";
  $result = 	mysqli_query($db, $query);

	


 while($row =  $result->fetch_assoc()) {

		 if($x==$i)
		 {
			 break;
		 }
		 $x++;
	}
    $hotelname=$row["hotelname"];

	$query = "Update hotel SET approved=1 where hotelname ='$hotelname' " ;
	mysqli_query($db, $query);


}



if (isset($_POST['removesuspended'])) {


	$i=1;


	 $query = "Select hotelname ,username as owner from hotel where suspend=1";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["hotelname"]. "</td><td>" . $row["price"] . "</td><td>" . $row["location"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Reserve</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";

	
 echo "<tr><td>" . $row["hotelname"]. "</td><td>". $row["owner"].  "</td>";
		echo "<td><form  method=\"post\" >

  <input type=\"submit\"name=\"removesus\" value=" .$i."> remove this hotel from suspence</input>
</form> </td></tr>";

		$i++;
}
echo "</table>";
} else { echo "0 results"; }



$_SESSION['i']=$i;





}



if (isset($_POST['removesus'])) {

	$i=$_POST['removesus'];
//

	

$x=1;


$query = "Select hotelname ,username as owner from hotel where suspend=1 ";
  $result = 	mysqli_query($db, $query);

	


 while($row =  $result->fetch_assoc()) {

		 if($x==$i)
		 {
			 break;
		 }
		 $x++;
	}
    $hotelname=$row["hotelname"];

	$query = "Update hotel SET suspend=0 where hotelname ='$hotelname' " ;
	mysqli_query($db, $query);


}








if (isset($_POST['checkprevious'])) {


	$int=1;

	$rate= $_POST['ratings'];

$username =$_SESSION['username'];
	 $query = "SELECT * from reservations where username ='$username'  AND enddatedate< CURRENT_DATE ";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["hotelname"]. "</td><td>" . $row["price"] . "</td><td>" . $row["location"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Reserve</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";

	
 echo "<tr><td>" . $row["hotelname"]. "</td><td>". $row["startdate"].  "</td><td>". $row["type"].  "</td><td>". $row["enddatedate"]."</td><td>". $row["reservationid"]. "</td>";
		echo "<td><form  method=\"post\" >

  <input type=\"submit\"name=\"ronald\" value=" .$int."> rate this  reservation </input>
</form> </td></tr>";

		$int++;
}
echo "</table>";
} else { echo "0 results"; }



//$_SESSION['i']=$i;

$_SESSION['ratings']=$rate;



}



if (isset($_POST['ronald'])) {

	$i=$_POST['ronald'];
//	$result=$_SESSION['result'];
	$rate=$_SESSION['ratings'];
	$username =$_SESSION['username'];
	




$x=1;


$query = "SELECT * from reservations where username ='$username'  AND enddatedate< CURRENT_DATE";
  $results = 	mysqli_query($db, $query);


  if ($results->num_rows > 0) {
	


	
 while($row =  $results->fetch_assoc()) {

		 if($x==$i)
		 {
			$id=$row["reservationid"];
			$hotelname= $row["hotelname"];

			
				$query = " UPDATE reservations  SET  rate= '$rate', checkrate='1' WHERE reservationid='$id' " ;
				

			mysqli_query($db, $query);

				
			 break;
		 }
		 $x++;
		
	}

	$query ="SELECT AVG(rate) as average from reservations where hotelname ='$hotelname' AND checkrate='1' ";
	$results=mysqli_query($db, $query);

	if ($results->num_rows > 0) {
	$row =  $results->fetch_assoc();
	$rate= $row["average"];

	$query ="UPDATE hotel SET  rating='$rate' where hotelname='$hotelname'";
	mysqli_query($db, $query);

	}



}


}





if (isset($_POST['checkclassa'])) {


	$customer =  $_POST['customer'];

	if (empty($customer)) { array_push($errors, "Customer to blacklist is required"); }



	if (count($errors) == 0) {


		$query = "SELECT * FROM customer WHERE username='$customer' AND  classa='1'";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) {

			$_SESSION['customerclassa'] = $customer;
			$_SESSION['success'] = "is a   classA";

			header('location: successclassa.php');
		}
		else {
			$_SESSION['customerclassa'] = $customer;
			$_SESSION['success'] = "is not a  classA";

			header('location: successclassa.php');


		}
	}


	



}




if (isset($_POST['searchvisit'])) {


	$i=1;
$hotelname=$_SESSION['hotelname'];

	 $query = "Select username as customer,type,hotelname,reservationid  from reservations where approved=0 and hotelname='$hotelname'";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["customer"]. "</td><td>" . $row["type"] . "</td><td>" . $row["hotlename"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Approve Visit</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";

	
 echo "<tr><td>" . $row["customer"]. "</td><td>". $row["type"]. "</td><td>" . $row["hotelname"].  "</td>";
		echo "<td><form  method=\"post\">

  <input type=\"submit\"name=\"approvevisit\" value=" .$i."> Approve this visit</input>
</form> </td></tr>";

		$i++;
}
echo "</table>";
} else { echo "0 results"; }



$_SESSION['i']=$i;





}



if (isset($_POST['approvevisit'])) {

	$i=$_POST['approvevisit'];
//
$hotelname=$_SESSION['hotelname'];
	

$x=1;


$query = "Select username as customer,type,hotelname,reservationid  from reservations where approved=0 and hotelname='$hotelname' ";
  $result = 	mysqli_query($db, $query);

	


 while($row =  $result->fetch_assoc()) {

		 if($x==$i)
		 {
			 break;
		 }
		 $x++;
	}
    $reservationid=$row["reservationid"];

	$query = "Update reservations SET approved=1 where reservationid ='$reservationid' " ;
	mysqli_query($db, $query);


}












if (isset($_POST['searchcust'])) {


	$i=1;
$hotelname=$_SESSION['hotelname'];

	 $query = "Select username as customer,type,hotelname,reservationid  from reservations where approved=1 and hotelname='$hotelname' and appear=0";
	 $result = 	mysqli_query($db, $query);
 echo "<table>";
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
  //  echo "<tr><td>" . $row["customer"]. "</td><td>" . $row["type"] . "</td><td>" . $row["hotlename"]. "</td></tr> <button type=\"submit\"  formmethod=\"post\" class=\"btn\" name=\"reserve\" value=" .$i."/>Approve Visit</button>";
		//  echo "<a href=\"register.php\">reseveve</a>";
		// echo " <button type=\"submit\" class=\"btn\" name=\"search\">Search</button>";

	
 echo "<tr><td>" . $row["customer"]. "</td><td>". $row["type"]. "</td><td>" . $row["hotelname"].  "</td>";
		echo "<td><form  method=\"post\">

  <input type=\"submit\"name=\"approvecheck\" value=" .$i."> check</input>
</form> </td></tr>";

		$i++;
}
echo "</table>";
} else { echo "0 results"; }



$_SESSION['i']=$i;





}



if (isset($_POST['approvecheck'])) {

	$i=$_POST['approvecheck'];
//
$hotelname=$_SESSION['hotelname'];
	

$x=1;


$query = "Select username as customer,type,hotelname,reservationid  from reservations where approved=1 and hotelname='$hotelname' and appear=0 ";
  $result = 	mysqli_query($db, $query);

	


 while($row =  $result->fetch_assoc()) {

		 if($x==$i)
		 {
			 break;
		 }
		 $x++;
	}
    $reservationid=$row["reservationid"];

	$query = "Update reservations SET appear=1 where reservationid ='$reservationid' " ;
	mysqli_query($db, $query);


}


















?>
