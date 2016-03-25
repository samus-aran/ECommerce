<html>
<head></head>
<body>

<?php

// retrieve form data

$inputFirst = $_POST['msgFirst'];
$inputLast = $_POST['msgLast'];
$inputEmail = $_POST['msgEmail'];
$inputAddress1 = $_POST['msgAddress1'];
$inputAddress2 = $_POST['msgAddress2'];
$inputCity = $_POST['msgCity'];
$inputCounty = $_POST['msgCounty'];
$inputPostcode = $_POST['msgPostcode'];
$inputDOB = $_POST['msgDOB'];

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
Delivery Address : <i>$inputFullAddress, $inputCity, $inputCounty, $inputPostcode</i><br />
Date of Birth = <i>$inputDOB</i><br />";

?>

</body>
</html>