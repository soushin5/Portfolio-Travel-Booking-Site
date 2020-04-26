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
	   <form>
	     <fieldset>
             <?php
	            require_once "dbFunctions.php";
		        $database=new DB_Functions();
		        $database->connectDB();
		        $query = "SELECT `Item Name`,`Item Number`, `In Stock`, `Item Type`, `Description`, `Price`  
			              FROM `inventory`";
		        $database->browse($query);
		        $database->destruct();
	         ?>
	      </fieldset>
	   </form>
	</body>
</html>