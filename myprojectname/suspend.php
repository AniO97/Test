<!DOCTYPE html>
<html>
<head>
 <title>Table with database</title>
 <style>
  table {
   border-collapse: collapse;
   width: 50%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
 <table>
 <tr>
  <th></th> 
  <th>HotelName</th> 
  <th>OwnerName</th>
  <th> first name</th> 
  <th> last name</th> 
  
 </tr>
 <?php
$conn = mysqli_connect("localhost", "root", "", "brokerdb");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT  h.hotelname,o.username,o.fname,o.lname FROM hotel as h join owner as o on o.username=h.username where suspend=1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr> <td>" . $row["hotelname"]. "</td> <td>" . $row["username"] . "</td> <td>" . $row["fname"]. "</td> <td>". $row["lname"]. "</td></tr>";
  
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>

<p>
		 <a href="brokermain.php">Return to home page</a> </p>
</body>
</html>