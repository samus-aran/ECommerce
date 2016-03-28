<?php
// start session

session_start();

// check if they're logged in
if (!$_SESSION['auth'] == 1)
{
	// if not logged in 
	// link to Log in and Index
	
	echo "You are not logged in! <a href='login.php'>Click here to Log In.</a>";
	echo "<br><a href='index.php'>Return to index</a>";
	
}
else
{
	
// retrieve form data

$inputProductID = $_POST['itemProduct'];
$inputSizeID = $_POST['itemSize'];
$inputColourID = $_POST['itemColour'];

// NEXT STEP: PULL INFO FROM DATABASE AND SAVE BASKET TO SESSION

echo "Added ".$inputProductID." ".$inputSizeID." ".$inputColourID." to basket!";

echo "<br><a href='index.php'>Return to index</a>";
}
?>