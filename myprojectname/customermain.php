<?php include('server.php') ?>


<form name="search" method="POST" action="customermain.php">

<?php

$db = mysqli_connect('localhost', 'root', '', 'brokerdb');
$query="SELECT distinct  location from hotel";
$results = mysqli_query($db, $query);
$options="";
$optionday="";
$optionmonth="";
$optionyear="";
while ($rows=mysqli_fetch_array($results)) {
  $options = $options."<option>$rows[0]</option>";
}
$options = $options."<option value =\"%\">any</option>";

for($i=1;$i<=31;$i++)
{
  $optionday = $optionday."<option>$i</option>";

}

for($i=1;$i<=12;$i++)
{
  $optionmonth = $optionmonth."<option>$i</option>";

}


for($i=2018;$i<=2020;$i++)
{
  $optionyear= $optionyear."<option>$i</option>";

}
?>

<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2>Search</h2>
  <select name="price">
    <option value="100">price</option>
      <option value="200"><200</option>
        <option value="500"><500</option>
          <option value="100"><1000</option>
          <option value="10000000">any</option>


  </select>
  <select name="stars">
    <option value="3">stars</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="%">any</option>
  </select>
  <select name="location">
    <option value="location">Location</option>
    <?php echo $options;?>
  </select>
  <select name="ratings">
    <option value="3">ratings</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="%">any</option>
  </select>
  <select name="roomtype">
    <option value="single">Room Type</option>
    <option value="single">Single</option>
    <option value="double">Double</option>
    <option value="suite">Suite</option>
    <option value="king">King</option>
    <option value="queen">Queen</option>
    <option value="%">any</option>
  </select>


  <div class="input-group">

  <label id="pass">Start date for reservation</label>

			<select name="startday">
    <?php echo $optionday;?>
		</select>

    <select name="startmonth">
    <?php echo $optionmonth;?>
		</select>

    <select name="startyear">
    <?php echo $optionyear;?>
		</select>

    </div>

    <div class="input-group">

  <label id="pass">End date for reservation</label>

			<select name="endday">
    <?php echo $optionday;?>
		</select>

    <select name="endmonth">
    <?php echo $optionmonth;?>
		</select>

    <select name="endyear">
    <?php echo $optionyear;?>
		</select>

    </div>

  <div class="input-group">
    <button type="submit" class="btn" name="search">Search</button>
  </div>
  
  <p>
		 <a href="mainforcustomer.php">Return to home page</a> </p>

  <p> <a href="index.php?logout='1'" style="color: blue;">logout</a> </p>

  
</form>
<br>

</body>

</html>