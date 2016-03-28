<?php

require("connection.php");

if (isset($_POST['name']) || isset($_POST['pass']))
{
	// form submitted
	
	// check for values
	
	if (empty($_POST['name']))
	{
		die ("ERROR: Please enter an username.");
	}
	
	if (empty($_POST['pass']))
	{
		die ("ERROR: Please enter a password.");
	}
	
	// create query 
	
	$query = "SELECT * FROM customer WHERE CustomerEmail = '" . $_POST['name'] . "' AND CustomerPass = '" . hash('ripemd160', $_POST['pass']) . "'";
	
	// execute query
	
	$result = mysqli_query($connection, $query) or die ("Error in query: $query. " . mysqli_error($connection));
	
	// check if any rows were returned
	
	if (mysqli_num_rows($result) == 1)
	{
		// if a row was returned then authentication was a success
		
		// so create a session and set cookie with username
		
		//session_start();
		
		$_SESSION['auth'] = 1;
		
		setcookie("username", $_POST['name'], time()+(84600*30));
		
		// set session for ID
		
		$row = mysqli_fetch_object($result);
		
		$_SESSION['userID'] = "$row->idCustomer";
		
		echo "Access granted!<br />";
		
		echo $_SESSION['userID'];
		
		?>
			
			<html>
			<head></head>
			<body>
			
			<br />
			<a href="profilepage.php">Go to your Profile Page.</a><br />

			</body>
			</html>
			
		<?php
	}
	
	else
	{
		// no result, therefore authentication failed
		
		echo "ERROR: Inorrect username or password!";
		
		?>
			
			<html>
			<head></head>
			<body>
			
			<center>
			
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			Email Address <input type="text" name="name" value="<?php echo $_COOKIE["username"]; ?>">
			<p />
			Password <input type="password" name="pass">
			<p />
			<input type="submit" name="submit" value="Log In">
			
			</center>

			</body>
			</html>
			
		<?php
	}
	
	// free result
	mysqli_free_result($result);
	
	// close connection
	mysqli_close($connection);
}

else
{
	// no submission, so display the login form
?>
	
	<html>
	<head></head>
	<body>
	
	<center>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
	Email Address <input type="text" name="name" value="<?php echo $_COOKIE["username"]; ?>">
	<p />
	Password <input type="password" name="pass">
	<p />
	<input type="submit" name="submit" value="Log In">
	
	</center>

	</body>
	</html>
	
<?php

}

?>

<html>
<head></head>
<body>

<br />
<a href="index.php">Back to Index</a><br />

</body>
</html>