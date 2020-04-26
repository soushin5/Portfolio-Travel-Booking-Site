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
	<script src="jsFunctions.js"></script>
    <title>WayCool Traveling</title>
  </head>
  <body>
     <form>
	    <fieldset>
		   <?php
	            require_once "dbFunctions.php";
		        $database=new DB_Functions();
		        $database->connectDB();
		        $database->orderUpdate($_SESSION['seat'], $database->getFullName($_SESSION['user_id']),
                                       $database->getAddress($_SESSION['user_id']), 1, $database->getCcNumber($database->getFullName($_SESSION['user_id'])));
		        $database->destruct();
	         ?>
		</fieldset>
	 </form>
  </body>
</html>