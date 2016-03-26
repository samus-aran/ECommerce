<html>

<head></head>

<body>

This is a test line of text to make sure nothing is horribly wrong.

<br />

<?php 

//define variables

$name = 'Inigo Montoya';

$relative = 'father';

$price1 = 9.99;

$price2 = 11.99;

$priceTotal = $price1 + $price2;

//print output

echo "My name is <b>$name</b>. You killed my <b>$relative</b>. Prepare to die.<br />";

echo '£'.$price1.' added to £'.$price2.' totals to £'.$priceTotal.'.<br />';

?>

<br /><a href="form.html">Sign Up</a><br />

<br /><a href="index.html">Back to Index</a><br />

<br />
<?php

// initialise a session_cache_expire

session_start();

// increment a session counter

$_SESSION['counter']++;

// print value

echo "You have viewed this page " . $_SESSION['counter'] . " times.";

?>
<br />

</body>

</html>