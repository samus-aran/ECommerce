<html>

<head>This is a website sort of???</head><br />
<body>

<a href="testpage.php">Go To Test Page</a><br />
<a href="itemlist.php">View Item List</a><br />

<?php
session_start();

if (!isset($_SESSION['auth']) || !$_SESSION['auth'] == 1)
{	
	echo "<a href='form.html'>Sign Up</a><br />";
	echo "<a href='login.php'>Log In</a><br />";
}
else
{
	echo "<a href='profile.php'>View Profile</a><br />";
	echo "<a href='logout.php'>Log out</a><br />";
}
?>

</body>
</html>

