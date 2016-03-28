<html>

<head></head>
<body>

<?php

// set database server access variables:

$host = "localhost";

$user = "root";

$pass = "";

$db = "ECommerce";

// open connection

$connection = mysqli_connect($host, $user, $pass) or die ("Unable to connect!");

// select database

mysqli_select_db($connection, $db) or die ("Unable to select database!");

// create queries 

$queryProduct = "SELECT * FROM product";
$querySize = "SELECT * FROM size";
$queryColour = "SELECT * FROM colour";

// execute queries

$resultProduct = mysqli_query($connection, $queryProduct) or die ("Error in query: $queryProduct.".mysqli_error());

// see if any rows were returned

if (mysqli_num_rows($resultProduct) > 0) 
{
	// yes, then print them
	
	echo "<table cellpadding=15 border=2>";
	
	while($row = mysqli_fetch_row($resultProduct)) 
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

// free result for next query

mysqli_free_result($resultProduct);

// ITEM SELECTION MENUS //

// set menus for user selection
?>

<form action="addbasket.php" method="post">
<p>Select item</p>
<select name="itemProduct">
	<?php
	// Query Product Table
	$resultProduct = mysqli_query($connection, $queryProduct) or die ("Error in query: $queryProduct.".mysqli_error());
	
	// while loop to fill drop menu
	while(list($idProduct, $name) = mysqli_fetch_row($resultProduct))
	{
		?>
		<option value="<?php echo $idProduct ?>"><?php echo $name ?></option>;
		<?php
	}
	?>
</select>

<select name="itemSize">
	<?php
	// Query Size Table
	$resultSize = mysqli_query($connection, $querySize) or die ("Error in query: $querySize.".mysqli_error());
	
	// while loop to fill drop menu
	while(list($idSize, $size) = mysqli_fetch_row($resultSize))
	{
		?>
		<option value="<?php echo $idSize ?>"><?php echo $size ?></option>;
		<?php
	}
	?>
</select>
	
<select name="itemColour">
	<?php
	// Query Colour Table
	$resultColour = mysqli_query($connection, $queryColour) or die ("Error in query: $queryColour.".mysqli_error());
	
	// while loop to fill drop menu
	while(list($idColour, $colour) = mysqli_fetch_row($resultColour))
	{
		?>
		<option value="<?php echo $idColour ?>"><?php echo $colour ?></option>;
		<?php
	}
	?>
</select>

<br><input type="submit" value="Add to the Basket">
</form>

<?php

// free result set memory 

mysqli_free_result($resultProduct);
mysqli_free_result($resultSize);
mysqli_free_result($resultColour);

// close connection

mysqli_close($connection);

?>

<br />
<a href="index.php">Back to Index</a><br />

</body>
</html>