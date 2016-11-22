<!--Web Development 2 Assingment-->
<!--Author: Gabriel Grimberg.-->
<!--Website: Library Website-->
<!--Page: Log In-->

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	    <!--Linking to CSS-->
		<link type="text/css" rel="stylesheet" href="Main-Style.css"/>
		<title>Log In</title>
	</head>
	
<body>

	<div div class="header">
		<div class="container">
	
	<!--Creating the Navigator-->
			<div id="menu">
			<ul class="nav">
				<li><a href="Main-Page.html">Welcome</a></li>
				<li><a href="Search.php">Search</a></li>
				<li><a href="Reservation.php">Reserve</a></li>
				<li><a href="Register.php">Register</a></li>
				<li><a href="Login.php">My Account</a></li>
			</ul>
			</div>
		</div>
	</div>
	
	<div class="backgroundfix4">
		<div class="container">  
			<div class="main">
				<h1>Log In</h1>
				<p class="btn-primary">Log in to access your account, view books and search for books.</p>
			</div>
		</div>
	</div>
					
	<!-- PHP to go here -->
	<?php
	

		//Connection to database.
		require('DatabaseConnect.php');
		
		//Starting the season.
		if(empty($_SESSION)) 
		{
			session_start();
		}
		
		//If the form is submitted.
		if(isset($_POST['Username']) and isset($_POST['Password']))
		{
			//Assinging the values entered into variables.
			$Username = $_POST['Username'];
			$Password = $_POST['Password'];
			
			//Comparing these variables to see if they match from the SQL Table.
			$Query = "SELECT * FROM UsersTable WHERE Username = '$Username' and Password = '".md5($Password)."'";
			 
			$Result = mysqli_query($Connection, $Query) or die(mysqli_error($Connection));
			$Count = mysqli_num_rows($Result);
			
			//If it matches create a new season.
			if ($Count == 1)
			{
				$_SESSION['Username'] = $Username;
			}
			//If not then display an error message.
			else
			{
				echo "<div class='Form'><h3>Username/Password entered is invalid, try again.</h3></div>";
			}
		}
		
		//If user is logged in, send a greeting message.
		if(isset($_SESSION['Username']))
		{
			$Username = $_SESSION['Username'];
			echo "<br><br>";
			echo "<div class='Form'><h1>Hello " . $Username . "<br></h1></div>";
			echo "<div class='Form'><h2>You have successfully logged in. <br></h2></div>";
			echo "<div class='Form'><h2>What would you like to do? <br></h2></div>";
			echo "<div class='Form'><h3><a href='Search.php'>Search For Books</a> <br></h3></div>";
			echo "<div class='Form'><h3><a href='Main-Page.html'>Go To Main Page</a> <br></h3></div>";
			echo "<div class='Form'><h3><a href='LoggedOut.php'>Not you? Logout.</a> <br></h3></div>";
			echo "<br><br>";
		 
		}
		else
		{		
	?>
	
	<div class="Form">
	<h1 class="loginheader">Log In</h1>
		<form action="" method="post" name="login">
			<input type="text" name="Username" placeholder="Username" required />
			<input type="password" name="Password" placeholder="Password" required />
			<input name="submit" type="submit" value="Login" />
		</form>
		
	<p>Not registered yet? <a href='Register.php'>Register Here</a></p>

	</div>
	
	<?php } ?>
		
    <!-- Start of footer -->
	<div class="clearfix"></div>
	<div  class="footer">
		<div class="container">
			<p>Copyright. 2016 All rights reserved.</p>
		</div>
	</div>
	
</body>
</html>