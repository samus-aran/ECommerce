<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="style.css" />  
    <title>Welcome!</title> 
</head>
<body>
 <div id="container"> 
  
        <div id="main"> 
		
			Welcome to this non-functioning web store!<br />
			<a href="testpage.php">Go To Test Page</a><br />
			<a href="shop.php">View Item List</a><br />
			
            <?php
			session_start();

			if (!isset($_SESSION['auth']) || !$_SESSION['auth'] == 1)
			{	
				echo "<a href='form.html'>Sign Up</a><br />";
				echo "<a href='loginpage.php'>Log In</a><br />";
			}
			else
			{
				echo "<a href='profilepage.php'>View Profile</a><br />";
				echo "<a href='logout.php'>Log out</a><br />";
			}
			?>
  
        </div><!--end of main--> 
          
        <div id="sidebar"> 
              
        </div><!--end of sidebar--> 
  
    </div><!--end container--> 

</body>
</html>

