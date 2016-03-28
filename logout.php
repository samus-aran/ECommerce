<?php
// start session

session_start();

// check if they're logged in
if ($_SESSION['auth'] == 1)
{
	// if not logged in 
	
	session_destroy();
	echo "You are logged out! <a href='login.php'>Click here to Log In.</a>";
	echo "<br><a href='index.php'>Return to index</a>";
	
}
else
{
	echo "<br><a href='index.php'>Return to index</a>";
}

?>