<?php
   class DB_Functions {
      public $conn;
	  private $query;
	  
	  
	  public function connectDB(){
	     $servername = "localhost";
         $username = "root";
         $password = "";
         $db_name = "final";
		 
		 //Form Connection with DB
		 $conn = mysqli_connect($servername, $username, $password, $db_name);	
		 $this->conn = $conn;
		 // Check connection
		 if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		       print "<script>console.log('Connection Failed');</script>";
			   
		 }
		 else{
			   print "<script>console.log('Connection Succeeded');</script>";
		 }
	  }
	  
	  // This will be called at the end of the script.
	  public function destruct(){
		 $conn = $this->conn;
	     if(mysqli_close($conn)){
	        print "<script>console.log('Connection Killed');</script>";
		 }
		 else {
		    print "<script>console.log('Connection Lives');</script>";
		 }	
      }
	  
	  //generic query with no security
	  public function query($q){
	     $conn = $this->conn;
		 $result = mysqli_query($conn,$q);
         return mysqli_query($conn, $q);
	  }
	  
	  //Query with prepared statement. Used to insert user information to database on signup
	  public function signup($name, $email, $bAddress, $uname, $pword){
		  $conn = $this->conn;
		  $pword=password_hash($pword, PASSWORD_BCRYPT);
		  $stmt = $conn->prepare("INSERT IGNORE INTO `customers` (`Name`, `email`, `bAddress`, `Username`, `Password`)
								  VALUES (?, ?, ?, ?, ?)");
		  $stmt->bind_param("sssss", $name, $email, $bAddress, $uname, $pword);
		  if($stmt->execute()){
				 print "<h2>Registration Successful</h2>";
				 print "<a href='login.php' id='noAdjust'>Login </a>";
		  } else {
				 print "<h2>Registration Failed</h2>";
				 print "<a href='signup.php' id='noAdjust'>Go Back</a>";
		  }  
	  }
	  
	  //Query with prepared statement. Used to select information from database during Login
	  public function login($loginU, $loginP){
		  $conn = $this->conn;
		  $plainP = $loginP;
		  $stmt = $conn->prepare("SELECT `username`, `password` 
		                          FROM `customers` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $loginU);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($loginU, $loginP);
		  $stmt->fetch();
		  if(password_verify($plainP, $loginP)){
			 print "<h1>Login Succeeded!</h1>
				    <h2>Welcome ";
			 print $_POST["loginU"];
			 print "</h2><br></br>";
			 print "<a href='main.php'> Plan your TRIP!</a>";
			 return true;
		  } else{
			 print "<h2>Login Failed</h2>";
			 print "<br></br>";
			 print "'<a href='voterLogin.php'> Try Again.</a>'";
			 return false;
		  }
	  }
	  //Query with prepared statement. Used to insert CC information to database on registration
	  public function ccRegister($number, $security, $ccName, $expiry, $bAddress){
		  $conn = $this->conn;
		  $stmt = $conn->prepare("INSERT IGNORE INTO `cc` (`Number`, `Security`, `Owner`, `Expiration`, `bAddress`)
								  VALUES (?, ?, ?, ?, ?)");
		  $stmt->bind_param("sssss", $number, $security, $ccName, $expiry, $bAddress);
		  if($stmt->execute()){
				 print "<h2>Registration Successful</h2>";
		  } else {
				 print "<h2>Registration Failed</h2>";
				 print "<a href='cc.php' id='noAdjust'>Go Back</a>";
		  }  
	  }
	  
	  //query to browse inventory
	  public function browse($q){
		  $conn = $this->conn;
		  $result = mysqli_query($conn,$q);
		  
		  while($row = $result->fetch_assoc()) {
		    print "<br> Item Name: ". $row["Item Name"]. " - Item Number: ". $row["Item Number"].
         		    " - In Stock" . $row["In Stock"]. " - Item Type: ". $row["Item Type"].
                    " - Description" . $row["Description"]. " - Price: ". $row["Price"] . "<br>";
         }
	  }
	  
	  //query to view user information in profile
	  public function viewUser($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `id`,`Name`, `email`, `bAddress`, `username` 
		                          FROM `customers` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
          if($result->num_rows === 0) 
			  print_r('No rows');
          while($row = $result->fetch_assoc()) {
             print "" . $row["Name"]. " - Email: " . $row["email"]. " - Billing Address: ". $row["bAddress"].
                    " - Username: ". $row["username"];
		  }
	  }
	  
	  //query to view order information in profile
	  public function viewOrders($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `Order Number`,`Item Name`, `Customer Name`, `sAddress`, `Amount`
		                          FROM `orders` 
				                  WHERE `Customer Name`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
          if($result->num_rows === 0)
			  print_r('No rows');
          while($row = $result->fetch_assoc()) {
             print "Order Number: " . $row["Order Number"]. " - Item Name: " . $row["Item Name"].
    			   " - Customer: ". $row["Customer Name"]. " - Shipping Address: ". $row["sAddress"].
				   " - Amount: " . $row["Amount"];
		  }
	  }
	  
	  //quick query to get full name of user
	  public function getFullName($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `Name`
		                          FROM `customers` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
		  if($result->num_rows === 0)
			  print_r('No rows');
		  $row = $result->fetch_assoc();
		  return $row["Name"];
	  }
      //quick query to get address of user
	  public function getAddress($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `bAddress`
		                          FROM `customers` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
		  if($result->num_rows === 0)
			  print_r('No rows');
		  $row = $result->fetch_assoc();
		  return $row["bAddress"];
	  }
	  //query to view order information in profile
	  public function viewCC($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `Number`,`Security`, `Owner`, `Expiration`, `bAddress`
		                          FROM `cc` 
				                  WHERE `Owner`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
          if($result->num_rows === 0) exit('No rows');
          while($row = $result->fetch_assoc()) {
             print "Card Number: " . $row["Number"]. " - Security Code: " . $row["Security"].
    			   " - Name on Card: ". $row["Owner"]. " - Expiration Date: ". $row["Expiration"].
				   " - Billing Address: " . $row["bAddress"];
		  }
	  }

      //quick query to get CC number of user
	  public function getCcNumber($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `Number`
		                          FROM `cc` 
				                  WHERE `Owner`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
		  if($result->num_rows === 0)
			  print_r('No rows');
		  $row = $result->fetch_assoc();
		  return $row["Number"];
	  }
	  
	  //query to update the orders table
	  public function orderUpdate($iN, $cN, $sA, $A, $cc){
		  $conn = $this->conn;
		  $stmt = $conn->prepare("INSERT IGNORE INTO `orders` (`Item Name`, `Customer Name`, `sAddress`, `Amount`, `CC Number`)
                                  VALUES (?, ?, ?, ?, ?)");
		  $stmt->bind_param("sssis", $iN, $cN, $sA, $A, $cc);
		  if($stmt->execute()){
				 print "<h2>Order Updated</h2>";
				 print "<a href='main.php' id='noAdjust'>Main Page </a>";
				 print "<a href='logout.php' id='noAdjust'>Logout </a>";
		  } else {
				 print "<h2>Order Failed</h2>";
				 print "<a href='checkout.php' id='noAdjust'>Go Back</a>";
		  }
	  }
   }
?>