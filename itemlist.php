<html>

<head></head>
<body>

<?php

// set database server access variables:

$host = "localhost";

$user = "root";

$pass = "";

$db = "localhost/my-site/sql/ECommerce";

// open connection

$connection = mysqli_connect($host, $user, $pass) or die ("Unable to connect!");

// select database

mysql_select_db($db) or die ("Unable to select database!");

// create query 

$query = "SELECT * FROM product";

// execute query

$result = mysqli_query($query) or die ("Error in query: $query.".mysqli_error());

// see if any rows were returned

if (mysqli_num_rows($result) > 0) 
{
	// yes, then print them
	
	echo "<table cellpadding=15 border=2>";
	
	while($row = mysqli_fetch_row($result)) 
	{
		echo "<tr>";
		
		echo "<td>".$row[0]."</td>";
		
		echo "<td>".$row[1]."</td>";
		
		echo "</tr>";
	}
	
	echo "</table>";
}

else
	
{
	// no, print status
	
	echo "No rows found!";
	
}

// free result set memory 

mysqli_free_result($result);

// close connection

mysqli_close($connection);

?>

</body>
</html>