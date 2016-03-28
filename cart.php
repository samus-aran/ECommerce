<h1>Cart</h1> 
<?php 
require("connection.php");
			  
if(isset($_SESSION['cart']))
{ 
					  
$sql="SELECT * FROM product WHERE idProduct IN ("; 
					  
foreach($_SESSION['cart'] as $id => $value) 
{ 
	$sql.=$id.","; 
}
					  
$sql=substr($sql, 0, -1).") ORDER BY ProductName ASC"; 
$query = mysqli_query($connection, $sql); 
while($row=mysqli_fetch_array($query))
	{ 					  
	?> 
		<p><?php echo $row['ProductName'] ?> x <?php echo $_SESSION['cart'][$row['idProduct']]['quantity'] ?></p> 
	<?php 					  
	} 
?> 
	<hr /> 
	<a href="index.php?page=cart">Go to cart</a> 
<?php 
					  
}
	else
	{ 
					  
		echo "<p>Your Cart is empty. Please add some products.</p>"; 
				  
	} 
			  
?>