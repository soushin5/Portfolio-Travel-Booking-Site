<!DOCTYPE html>

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
		  if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['bAddress']) || empty($_POST['uname'])
     			   || empty($_POST['pword'])){
		     print "One or more of your fields are empty. Please go back and correct the error.";
		  } else if($_POST['pword'] !== $_POST['pword2']){
			  print "Password does not match";
		  }
		  /*else {
		     $name = $_POST['name']; $email = $_POST['email']; $bAddress = $_POST['bAddress']; $uname = $_POST['uname'];
			 $pword = $_POST['pword'];
		     $query="INSERT IGNORE INTO `customers` (`Name`, `email`, `bAddress`, `Username`, `Password`)
				     VALUES('$name', '$email', '$bAddress', '$uname', '$pword')";
		     if($database->query($query)){
				 print "<h2>Registration Successful</h2>";
				 print "<a href='login.php' id='noAdjust'>Login </a>";
			 } else {
				 print "<h2>Registration Failed</h2>";
				 print "<a href='signup.php' id='noAdjust'>Go Back</a>";
			 }
		  }*/
		  else {
		     $database->signup($_POST['name'],$_POST['email'],$_POST['bAddress'],$_POST['uname'],$_POST['pword']);
		  }
		  $database->destruct();
	   ?>
	</body>
</html>