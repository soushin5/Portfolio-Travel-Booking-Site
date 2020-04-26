<?php
   session_start();
   if(empty($_SESSION['user_id'])){
	   print "Please log in";
	   header("Location:login.php");
   }
?>
<html>
  <head>
	<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="wcwd.png" />
    <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
    <title>WayCool Traveling</title>
  </head>
  <body>
     <form method="post" action="cc-submit.php">
	    <h1>Credit Card Registration</h1>
	    <fieldset class="adjust">
		   <p>
		      <label class="left">Credit card Number: </label>
			  <label class="right">Security Code: </label>
			  <br>
			  <input type="text" class="left "name="number" class="textbox" id="cc-num" size="16"/> 
			  <input type="text" class="right" name="security" class="textbox" size="3"/> 
		   </p>
		   <p>
		      <label class="left">Name on Card: </label> 
			  <label class="right">Expiration Date: </label>
			  <br>
			  <input type="text" class="left "name="ccName" class="textbox" size="12"/> 
			  <select name="month">
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
				&sol;
                <select name="year">
                    <option value="17"> 2017</option>
                    <option value="18"> 2018</option>
                    <option value="19"> 2019</option>
                    <option value="20"> 2020</option>
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                </select>
		   </p>
		   <fieldset>
		      <p id="cc-type"></p>
		   </fieldset>
		   <p>
		      <label class="left">Billing Address: </label>
		      <input type="text" class="left "name="bAddress" class="textbox" placeholder="for Card"/> 
		   </p>
		</fieldset>
		<input type="submit" name="submit" value="Submit">
	 </form>
	 <script src="jsFunctions.js"></script>
  </body>
</html>