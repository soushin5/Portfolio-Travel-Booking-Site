<!DOCTYPE html>
<?php
   session_start();
   if(empty($_SESSION['user_id'])){
	   print "Please log in";
	   header("Location:login.php");
   }
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
        <title>WayCool Traveling</title>
    </head>
    <body>
        <div id="topcorner">
            <a href="shoppingCart.php" class="topa">View Cart</a>
            <a href="main.php" class="topa">Back to Main</a>
        </div>
        <h1>WayCool Traveling</h1>
        <h2>User Profile</h2>
        <div id="box">
		   <p>
               <h3>Name</h3>
			   <p>
			      <?php
	                 require_once "dbFunctions.php";
		             $database=new DB_Functions();
		             $database->connectDB();
		             $database->viewUser($_SESSION['user_id']);
			      ?> 
			   </p>
		   </p>
		   <p>
               <h3>Recent Orders</h3>
			   <p>
			      <?php
		             $database->viewOrders($_SESSION['user_id']);
			      ?> 
			   </p>
		   </p>
		   <p>
              <h3>Current Credit Card on File</h3>
			  <p>
			     <?php
				    $database->viewCC($database->getFullName($_SESSION['user_id']));
				 ?>
			  </p>
		   </p>
        </div>
    </body>
</html>