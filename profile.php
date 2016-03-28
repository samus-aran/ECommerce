<?php

// start session

//session_start();
require("connection.php");

if (!isset($_SESSION['auth']) || !$_SESSION['auth'] == 1)
{
	// check authentication else die
	
	die ("ERROR: UNAUTHORIZED ACCESS! >:(");
	
}

else
{
?>
	
	<html>
	<head></head>
	<body>
	
	This is your profile page. Only viewable when you are authenticated.<br />
	
	</body>
	</html>
	
<?php

// DISPLAY PROFILE INFO

// create query 

$query = "SELECT * FROM customer WHERE idCustomer = '" . $_SESSION['userID'] . "'";

// execute query

$result = mysqli_query($connection, $query) or die ("Error in query: $query.".mysqli_error($connection));

// check if any rows were returned
	
	if (mysqli_num_rows($result) == 1)
	{
		// if returned then user exists
		
		// display their profile information
		
		list($userID, $userFirst, $userLast, $userEmail, $userAddress1, $userAddress2, $userCity, $userCountry, $userPostcode, $userPhone, $userDOB) = mysqli_fetch_row($result);
		
		//Check whether Address 2 was filled out, and conjoin 1 and 2 if so.
		
		$userFullAddress = $userAddress2 != null ? $userAddress1.', '.$userAddress2 : $userAddress1;
		
		// Display Info
		echo "Full Name : <i>$userFirst $userLast</i><br />
		Email Address : <i>$userEmail</i><br />
		Delivery Address : <i>$userFullAddress, $userCity, $userCountry, $userPostcode</i><br />
		Phone No. : <i>$userPhone</i><br />
		Date of Birth : <i>$userDOB</i><br />";
	}
	
	else
	{
		// if no results then no user exists for this ID
		
		echo "No user is attached to this ID!";
	}

// free result
mysqli_free_result($result);

// close connection
mysqli_close($connection);
	
}

?>

<html>
<head></head>
<body>

<br />
<a href="index.php">Back to Index</a><br />

</body>
</html>