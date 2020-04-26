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
        <div id="topcorner">
            <a href="profile.php" class="topa">View Profile</a>
            <a href="shoppingCart.php" class="topa">View Cart</a>
			<a href="logout.php" class="topa">Log Out</a>
        </div>
        <h1>WayCool Traveling</h1>
        <a href="flight.php">Book a Flight</a>
        <br />
        <a href="prepay.php">Prepay Parking</a>
		<br />
        <a href="cc.php">Payment Method</a>
		<br />
        <a href="browse.php">Browse Inventory</a>
    </body>
</html>