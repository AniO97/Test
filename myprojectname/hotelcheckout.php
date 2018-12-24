<!DOCTYPE html>
<html>
<head>
 <title>Table with database</title>
 <style>
  table {
   border-collapse: collapse;
   width: 100%;
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
  <th>customer</th> 
  <th>Room type</th> 
  <th>start date</th> 
  <th>end date</th> 
  
 </tr>
 <?php
 session_start();
$conn = mysqli_connect("localhost", "root", "", "brokerdb");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 

  $hotelname=$_SESSION['hotelname'];
  $sql = "SELECT  *  FROM reservations where hotelname='$hotelname' AND enddatedate=CURRENT_DATE";
  $result = $conn->query($sql);
 
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["username"]. "</td><td>" . $row["type"] . "</td><td>" . $row["startdate"]. "</td><td>" . $row["enddatedate"]."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>

<a href="ownermain.php">Return to home page</a> </p>
</body>
</html>