<!DOCTYPE html>
<?php
   session_start();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
        <title>WayCool Traveling</title>
    </head>
    <body>
	   <!-- call to include DB Functions and connect to DB -->
       <?php
	      require_once "dbFunctions.php";
		  $database=new DB_Functions();
		  $database->connectDB();
		  $expiry = strval($_POST['month']).'&sol;'.strval($_POST['year']);
		  if(empty($_POST['number']) || empty($_POST['security']) || empty($_POST['ccName']) || empty($_POST['month'])
     			   || empty($_POST['year']) || empty($_POST['bAddress'])){
		     print "One or more of your fields are empty. Please go back and correct the error.";
		  } else {
		     $database->ccRegister($_POST['number'],$_POST['security'],$_POST['ccName'],$expiry,$_POST['bAddress']);
		  }
		  $database->destruct();
	   ?>
	   <a href="main.php">Main Page</a>
       <br />
	</body>
</html>