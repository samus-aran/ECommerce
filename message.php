<html>
<head></head>
<body>

<?php

require("connection.php");

// retrieve form data

$inputFirst = $_POST['msgFirst'];
$inputLast = $_POST['msgLast'];
$inputEmail = $_POST['msgEmail'];
$inputAddress1 = $_POST['msgAddress1'];
$inputAddress2 = $_POST['msgAddress2'];
$inputCity = $_POST['msgCity'];
$inputCountry = $_POST['msgCountry'];
$inputPostcode = $_POST['msgPostcode'];
$inputPhone = $_POST['msgPhone'];
$inputDOB = $_POST['msgYear'].'-'.$_POST['msgMonth'].'-'.$_POST['msgDay']; //$_POST['msgDOB'];
$inputPass = hash('ripemd160', $_POST['msgPass']);

$inputFullName = $inputFirst.' '.$inputLast;

//Check whether Address 2 was filled out
$inputFullAddress = $inputAddress2 != null ? $inputAddress1.', '.$inputAddress2 : $inputAddress1;
/*
The above code is identical to:
if ($inputAddress2 != null)
{
	$inputFullAddress = $inputAddress1.', '.$inputAddress2;
}
else
{
	$inputFullAddress = $inputAddress1;
}
*/

// use it

echo "Full Name : <i>$inputFullName</i><br />
Email Address : <i>$inputEmail</i><br />
Delivery Address : <i>$inputFullAddress, $inputCity, $inputCountry, $inputPostcode</i><br />
Phone No. : <i>$inputPhone</i><br />
Date of Birth : <i>$inputDOB</i><br /><br />
You have been registered!";

// STUFF //

// create the queries

$query = "INSERT INTO Customer (CustomerFirstName, CustomerLastName, CustomerEmail, CustomerAddress1, CustomerAddress2, CustomerCity, CustomerCountry, CustomerPostcode, CustomerPhone, CustomerDOB, CustomerPass) VALUES ('$inputFirst','$inputLast','$inputEmail','$inputAddress1','$inputAddress2','$inputCity','$inputCountry','$inputPostcode','$inputPhone','$inputDOB','$inputPass')";

// execute queries and insert into database

mysqli_query($connection, $query) or die ("Error in query: $query.".mysqli_error($connection));

// close connection

mysqli_close($connection);

?>

<br />
<a href="index.php">Back to Index</a><br />

</body>
</html>