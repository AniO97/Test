<?php include('server2.php') ?>
<h2>Search</h2>

<form name="search" method="POST" action="customercheckprevious.php">

<div class="input-group">

<label id="pass">please choose a rating first</label>
<select name="ratings">
    <option value="3">ratings</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    
  </select>
  </div>
  

  <div class="input-group">
    <button type="submit" class="btn" name="checkprevious">Search</button>
  </div>


  <p>
		 <a href="mainforcustomer.php">Return to home page</a> </p>

</form>
<br>
<p>
  
</p>