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
  <th>fname</th> 
  <th>lname</th> 
  <th>Username</th> 
  
 </tr>
 <?php
$conn = mysqli_connect("localhost", "root", "", "brokerdb");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT  username,fname,lname  FROM customer where blacklist=1";
  $result = $conn->query($sql);
 
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["fname"]. "</td><td>" . $row["lname"] . "</td><td>" . $row["username"]. "</td><td>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>


<p>	 <a href="ownermain.php">Return to home page</a> </p>
</body>
</html>