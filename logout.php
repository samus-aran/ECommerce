<html> 
<head>       
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="style.css" />  
    <title>Logged Out</title> 
</head> 
  
<body> 

	<div id="container"> 
  
        <div id="main">
		
		<?php
		// start session

		session_start();

		// check if they're logged in
		if ($_SESSION['auth'] == 1)
		{
			// if not logged in 
			
			session_destroy();
			echo "You are logged out! <a href='loginpage.php'>Click here to Log In.</a>";
			echo "<br><a href='index.php'>Return to index</a>";
			
		}
		else
		{
			echo "<br><a href='index.php'>Return to index</a>";
		}
		
		?>
		
		</div><!--end of main--> 
		
	</div><!--end container--> 
  
</body> 
</html>