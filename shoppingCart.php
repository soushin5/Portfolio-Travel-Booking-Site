<?php
   session_start();
   if(empty($_SESSION['user_id'])){
	   print "Please log in";
	   header("Location:login.php");
   }
    if(isset($_POST["seat"]))
    {
        $_SESSION["seat"] = $_POST["seat"];
    }
    $seat = $_SESSION["seat"];
    if(isset($_POST["parking"]))
    {
        $_SESSION["parking"] = $_POST["parking"];
        $parking = $_SESSION["parking"];
    }
    else
    {
        $parking = "";
    }
    require_once "dbFunctions.php";
	$database=new DB_Functions();
	$database->connectDB();
    {$query = "UPDATE `inventory` SET `In Stock`='0' WHERE `Item Name`='$seat'";}
    $database->query($query);
    $query = "UPDATE `inventory` SET `In Stock`='0' WHERE `Item Name`='$parking'";
    $database->query($query);
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
        <title>WayCool Traveling</title>
    </head>
    <body>
        <div id="topcorner">
            <a href="profile.php" class="topa">View Profile</a>
            <a href="main.php" class="topa">Back to Main</a>
        </div>
        <h1>Shopping Cart</h1>
        <div id="box">
            <?php
            $query = "SELECT `Item Name`, `Description`, `Price`
			        FROM `inventory`";
		    $result = $database->query($query);
            $array = array();
            while($row = $result->fetch_assoc()){
                if($row["Item Name"] == $seat || $row["Item Name"] == $parking)
                {
                    print "Item: ".$row["Item Name"]." Description: ".$row["Description"]." Price: $".$row["Price"];
                    echo "<br />";
                }
            }
            ?>
        </div>
		<p>
		   <?php
              if(isset($_POST["parking"])){
                 print "<a href='checkout.php'>Checkout</a>";
              } else {
                 print "<a href='prepay.php'>Now Choose Your Parking</a";
              }
            ?>
		</p>
    </body>
    <?php $database->destruct(); ?>
</html>