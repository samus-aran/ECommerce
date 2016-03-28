<?php
	// CONNECT TO THE DATABASE
	
	// set database server access variables:

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "ECommerce";

	// open connection

	$connection = mysqli_connect($host, $user, $pass) or die ("Unable to connect!");

	// select database

	mysqli_select_db($connection, $db) or die ("Unable to select database!");

?>