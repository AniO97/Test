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
  <th>hotelname</th> 
  <th>money</th> 
  <th>month</th> 
  
 </tr>
 <?php
$conn = mysqli_connect("localhost", "root", "", "brokerdb");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT hr.hotelname,sum(hr.price)*0.09 as money,MONTH(CURRENT_DATE) as month from reservations as r JOIN hotelroom as hr on r.hotelname=hr.hotelname AND r.type=hr.type AND MONTH(r.startdate)=MONTH(CURRENT_DATE) where r.appear=1 GROUP BY hr.hotelname";
  $result = $conn->query($sql);
 
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["hotelname"]. "</td><td>" . $row["money"] . "</td><td>" . $row["month"]. "</td><td>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>

<p><a href="brokermain.php">Return to home page</a> </p>
</body>
</html>