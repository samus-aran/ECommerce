<html>
<head>       
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="style.css" />  
    <title>Checkout</title> 
</head> 
<body>
<div id="container"> 
  
<div id="main">

	<?php
	require("connection.php");
	
	session_start();

	if(!isset($_SESSION['auth']) || !$_SESSION['auth'] == 1)
	{
		echo "<br>You are not logged in! <a href='loginpage.php'>Click here to Log In.</a>";
		echo "<br><a href='index.php'>Return to index</a>";
	}
	else
	{	
		if(isset($_SESSION['cart']))
		{ 
	
		// INSERT ORDER INTO DB
		$idUser = $_SESSION['userID'];
		$date = date('Y-m-d H:i:s');
		$queryAddOrder = "INSERT INTO orderlist (idCustomer, orderTime) VALUES ('$idUser', '$date')";
		mysqli_query($connection, $queryAddOrder);
		// grab the id that was just created
		$orderID = mysqli_insert_id($connection);
		echo $orderID;
		
		// Display cart list
		
		$sql="SELECT * FROM product WHERE idProduct IN ("; 
							  
		foreach($_SESSION['cart'] as $id => $value) 
		{ 
			$sql.=$id.","; 
		}
		
		$sql=substr($sql, 0, -1).") ORDER BY ProductName ASC"; 
		$query = mysqli_query($connection, $sql); 
		$totalcost = 0;
		while($row=mysqli_fetch_array($query))
		{
			
			// calculate cost
			$subtotal=$_SESSION['cart'][$row['idProduct']]['quantity']*$row['ProductPrice'];
			$totalcost += $subtotal;
			
			// print items
			?> 
				<p><?php echo $row['ProductName'] ?> x <?php echo $_SESSION['cart'][$row['idProduct']]['quantity'] ?>: £<?php echo $subtotal?></p> 
			<?php
			
			
			// declare variables
			$itemPrice = $row['ProductPrice'];
			$itemID = $row['idProduct'];
			$itemQuantity = $_SESSION['cart'][$row['idProduct']]['quantity'];
			// add items to orderdetails table
			$queryAddOrderDetail = "INSERT INTO orderdetails 
			(idOrder, idPrice, idProduct, Quantity, OrderDetailsTotalCost) 
			VALUES ('$orderID', '$itemPrice', '$itemID', '$itemQuantity', '$subtotal')";
			
			mysqli_query($connection, $queryAddOrderDetail) or die ("Error in query: $queryAddOrderDetail. " . mysqli_error($connection));
			
		} 
		mysqli_query($connection, "UPDATE orderlist SET orderTotalCost = '$totalcost' WHERE idOrder = '".$orderID."'");
		echo "Final Price: £".$totalcost;
		unset($_SESSION['cart']);
		?> 
			<hr /> 
			<br>Ok! Checkout and order has been completed!<br />
			<a href="index.php">Return to Index</a> 
		<?php	  
		}
		else
		{	  
			echo "<p>Your Cart is empty. Please add some products.</p>"; 
			echo "<br><a href='index.php'>Return to index</a>";
		} 
	}
	?>

</div>