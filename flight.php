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
    </head>
    <body>
        <div id="topcorner">
            <a href="profile.php" class="topa">View Profile</a>
            <a href="shoppingCart.php" class="topa">View Cart</a>
            <a href="main.php" class="topa">Back to Main</a>
        </div>
        <h1>Book a Flight</h1>
        <h2>Choose a Seat</h2>
        <?php
	        require_once "dbFunctions.php";
		    $database=new DB_Functions();
		    $database->connectDB();
		    $query = "SELECT `Item Name`, `In Stock`, `Item Type`
			        FROM `inventory`";
		    $result = $database->query($query);
            $array = array();
            while($row = $result->fetch_assoc()){
                if($row["Item Type"] == "Air Plane Seat")
                {
                    $array[$row["Item Name"]] = $row["In Stock"];
                }
            }
	    ?>
        <form action="shoppingCart.php" method="post">
            <table id="sarahTable">
                <tr id="head">
                    <th class="sarahth">A</th>
                    <th class="sarahth">B</th>
                    <th class="sarahth">C</th>
                    <th class="sarahth">&nbsp; &nbsp; &nbsp;</th>
                    <th class="sarahth">D</th>
                    <th class="sarahth">E</th>
                    <th class="sarahth">F</th>
                </tr>
                <?php
                    $count = 0;
                    foreach($array as $name => $stock)
                    {
                        $count++;
                        if($count == 7 || $count == 13 || $count == 19 || $count == 25 || $count == 31 || $count == 37 || $count == 43 || $count == 49 || $count == 55)
                        {
                            echo '<tr>';
                        }
                        if(strpos($name,'D'))
                        {
                            echo '<td class="sarahtd">&nbsp; &nbsp; &nbsp;</td>';
                        }
                        echo '<td class="sarahtd ';
                        if($stock==1){
                            echo 'seatAvailable" onclick="selected(this)"><input type="radio" name="seat" value="'.$name.'"/>';
                        }
                        else
                        {
                            echo 'seatUnavailable">';
                        }
                    }
                    if($count == 7 || $count == 12 || $count == 18 || $count == 24 || $count == 30 || $count == 36 || $count == 42 || $count == 48 || $count == 54)
                    {
                        echo '</tr>';
                    }
                ?>
            </table>
            <input type="submit" value="I Choose This Seat"/>
        </form>
        <?php $database->destruct(); ?>
    </body>
</html>