<!-- Voter Registraition page -->
<html>
   <head>
      <meta charset="utf-8" />
      <title> Sign-up Page </title>
	  <link rel="icon" type="image/png" href="wcwd.png" />
	  <link href="Stylesheet.css" rel="stylesheet" type="text/css">
   </head>
   
   <body>  
      <h1 class="adjust">Sign Up</h1>
	  <form method="post" action="signup-submit.php">
	     <fieldset>
			<p>
	           Name: <input name="name" type="text" placeholder="Full Name" size="16"> 
		    </p>
			<p>
	           Email: <input name="email" type="text" size="16"> 
		    </p>
			<p>
	           Address: <input name="bAddress" type="text" placeholder="Billing Address"> 
		    </p>
            <p>			
		       Username: <input name="uname" type="text" size="16">
			</p>   
		    <p>
		       Password: <input name="pword" type="text" size="16">
			</p>
			<p>
			   ReEnter Password: <input name="pword2" type="text" size="16">
			</p>
			<p>
               <input type="submit" name="submit" value="Submit">
			</p>
		 </fieldset>
	  </form>
   </body>
</html>