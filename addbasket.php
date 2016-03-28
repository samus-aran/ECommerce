<?php
// start session

session_start();
require("connection.php");

// check if they're logged in
if (!isset($_SESSION['auth']) || !$_SESSION['auth'] == 1)
{
	// if not logged in 
	// link to Log in and Index
	
	echo "You are not logged in! <a href='loginpage.php'>Click here to Log In.</a>";
	echo "<br><a href='index.php'>Return to index</a>";
	
}
else
{
	
	// retrieve form data

	$inputProductID = $_POST['itemProduct'];
	$inputSizeID = $_POST['itemSize'];
	$inputColourID = $_POST['itemColour'];

	// NEXT STEP: PULL INFO FROM DATABASE AND SAVE BASKET TO SESSION

	// create queries

	$queryProduct = "SELECT * FROM product WHERE idProduct = '" . $inputProductID . "'";
	$querySize = "SELECT * FROM size WHERE idSize = '" . $inputSizeID . "'";
	$queryColour = "SELECT * FROM colour WHERE idColour = '" . $inputColourID . "'";

	// execute queries
	
	$resultProduct = mysqli_query($connection, $queryProduct) or die ("Error in query: $queryProduct.".mysqli_error($connection));
	$resultSize = mysqli_query($connection, $querySize) or die ("Error in query: $querySize.".mysqli_error($connection));
	$resultColour = mysqli_query($connection, $queryColour) or die ("Error in query: $queryColour.".mysqli_error($connection));

	// Display what they added to their basket
	$rowProduct = mysqli_fetch_object($resultProduct);
	$rowSize = mysqli_fetch_object($resultSize);
	$rowColour = mysqli_fetch_object($resultColour);

	echo "Added a ".$rowColour->ColourList." ".$rowProduct->ProductName." in size ".$rowSize->SizeList." to your basket!";

	echo "<br><a href='index.php'>Return to index</a>";
	
	// free result set memory 

	mysqli_free_result($resultProduct);
	mysqli_free_result($resultSize);
	mysqli_free_result($resultColour);

	// close connection

	mysqli_close($connection);
}
?>