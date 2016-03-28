<html>

<head></head>
<body>

<?php
require("connection.php");

// if action from selection has been set to add

if(isset($_GET['action']) && $_GET['action']=="add")
{
	// set product id
    $id=intval($_GET['id']); 
	
	$message2 = "Added ".$id." to Cart";
    
	// if product already exists just add one more to item
    if(isset($_SESSION['cart'][$id]))
	{          
        $_SESSION['cart'][$id]['quantity']++; 
    }
	else
	{ 
		// set query and execute
		
        $queryCart="SELECT * FROM product 
            WHERE idProduct = '$id'"; 
        $resultCart=mysqli_query($connection, $queryCart); 
        if(mysqli_num_rows($resultCart)!=0)
		{ 
            $rowCart=mysqli_fetch_array($resultCart); 
                 
            $_SESSION['cart'][$rowCart['idProduct']]=array( 
                    "quantity" => 1, 
                    "price" => $rowCart['ProductPrice'] 
                ); 
        }
		else
		{ 
            $message="This product id is invalid!"; 
        }  
    } 
} 
	
if(isset($message))
{ 
    echo "".$message2.""; 
    echo "".$message.""; 
} 

 
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
	
	echo "<h1>Products</h1>";
	echo "<table cellpadding=15 border=2>";
	echo "<tr>	<th>ID</th> 
				<th>Name</th> 
				<th>Price</th>	</tr>";
	
	while($row = mysqli_fetch_row($resultProduct)) 
	{
		echo "<tr>";
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>£".$row[2]."</td>";
		echo "<td><a href='shop.php?page=itemlist&action=add&id= $row[0]'>Add to cart</a></td>";
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

<form action="shop.php?page=itemlist&id=<?php $itemProduct ?>&action=add">
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
<!--
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
-->
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