<?php 
require("connection.php");
  
if(isset($_POST['submit']))
{ 
	foreach($_POST['quantity'] as $key => $val) 
	{ 
	if($val==0) 
		{ 
			unset($_SESSION['cart'][$key]); 
		}
		else
		{ 
			$_SESSION['cart'][$key]['quantity']=$val; 
		} 
	} 
	  
} 
  
?> 
  
<h1>View cart</h1> 

<?php
if(!empty($_SESSION['cart']))
{ 
?>
	<form method="post" action="shop.php?page=viewcart"> 
    
    <table> 
          
        <tr> 
            <th>Name</th> 
            <th>Quantity</th> 
            <th>Price</th> 
            <th>Sub-total for items</th> 
        </tr> 
          
        <?php 
		
            $sql="SELECT * FROM product WHERE idProduct IN ("; 
                      
                    foreach($_SESSION['cart'] as $id => $value) 
					{ 
                        $sql.=$id.","; 
                    } 
                      
                    $sql=substr($sql, 0, -1).") ORDER BY ProductName ASC"; 
                    $query=mysqli_query($connection, $sql); 
                    $totalprice=0; 
                    while($row=mysqli_fetch_array($query)){ 
                        $subtotal=$_SESSION['cart'][$row['idProduct']]['quantity']*$row['ProductPrice']; 
                        $totalprice+=$subtotal; 
                    ?> 
                        <tr> 
                            <td><?php echo $row['ProductName'] ?></td> 
                            <td><input type="text" name="quantity[<?php echo $row['idProduct'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['idProduct']]['quantity'] ?>" /></td> 
                            <td>£<?php echo $row['ProductPrice'] ?></td> 
                            <td>£<?php echo $_SESSION['cart'][$row['idProduct']]['quantity']*$row['ProductPrice'] ?></td> 
                        </tr> 
                    <?php 
                          
                    } 
		
        ?> 
		<tr> 
			<td colspan="4">Total Price: £<?php echo $totalprice ?></td> 
		</tr> 

    </table> 
    <br /> 
    <button type="submit" name="submit">Update Cart</button> 
	</form> 
	<br /> 
	<p>To remove an item set its quantity to 0. </p>
	<br />
<?php	
}
else
{
	echo "Your cart is empty!";
	$totalprice = 0;
}
if($totalprice>0)
{
	echo "<p><a href='checkout.php'>Go to Checkout</a></p>";
}
?>
<br><a href="shop.php?page=itemlist">Go back to the products page.</a>
<br><a href="index.php">Back to Index</a>
