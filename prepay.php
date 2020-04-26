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
        <meta charset="utf-8"/>
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
        
        <script>
            function selected(element) {
                otherSeatTemp = document.getElementsByClassName("seatSelected");
                if (otherSeatTemp.length !== 0) {
                    otherSeat = otherSeatTemp[0];
                    otherSeat.classList.remove("seatSelected");
                    otherSeat.classList.add("seatAvailable");
                }
                element.classList.remove("seatAvailable");
                element.classList.add("seatSelected");
            }
        </script>

        <title>Prepay Parking</title>
        <script src="parkingScript.js"></script>
    </head>
    <body>
    <div id="topcorner">
        <a href="profile.php" class="topa">View Profile</a>
        <a href="shoppingCart.php" class="topa">View Cart</a>
        <a href="main.php" class="topa">Back to Main</a>
    </div>
        <h1>Parking Reservation</h1>
        <?php
	        require_once "dbFunctions.php";
		    $database=new DB_Functions();
		    $database->connectDB();
		    $query = "SELECT `Item Name`, `In Stock`, `Item Type` 
			        FROM `inventory`";
		    $result = $database->query($query);
            $array = array();
            $otherArray = array();
            $thirdArray = array();
            while($row = $result->fetch_assoc()){
                if($row["Item Type"] == "Parking Spot")
                {
                    $array[$row["Item Name"]] = $row["In Stock"];
                }
            }
	    ?>
        <div id="parkingGrid">
            <form action="shoppingCart.php" method="post">
                <table>
                    <?php
                    $count = 0;
                    foreach($array as $name => $stock)
                    {
                        $count++;
                        $VIPcheckArray = explode(" ",$name);
                        $VIPcheck = intval($VIPcheckArray[1]);
                        if($count == 1 || $count == 8 || $count == 15 || $count == 22 || $count == 29 || $count == 36 || $count == 43 || $count == 50)
                        {
                            echo '<tr>';
                        }
                        echo '<td class="sarahtd ';
                        if($VIPcheck < 15)
                        {
                            echo 'vip-card ';
                        }
                        if($stock==1){
                            echo 'seatAvailable" onclick="selected(this)"><label><input type="radio" name="parking" value="'.$name.'"/></label>';
                        }
                        else
                        {
                            echo 'seatUnavailable">';
                        }
                    }
                    if($count == 7 || $count == 14 || $count == 21 || $count == 28 || $count == 35 || $count == 42 || $count == 49)
                    {
                        echo '</tr>';
                    }
                ?>
                </table>
                <input type="submit" value="I Choose This Parking Spot"/>
            </form>
        </div>
        <?php $database->destruct(); ?>
    </body>
</html>
