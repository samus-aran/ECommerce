<?php 
    session_start(); 
    require("connection.php"); 
    if(isset($_GET['page'])){ 
          
        $pages=array("profile", "cart"); 
          
        if(in_array($_GET['page'], $pages)) { 
              
            $_page=$_GET['page']; 
              
        }else{ 
              
            $_page="profile"; 
              
        } 
          
    }else{ 
          
        $_page="profile"; 
          
    } 
  
?> 
 
<html> 
<head>       
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" href="style.css" />  
    <title>Profile Page</title> 
</head> 
  
<body> 
      
    <div id="container"> 
  
        <div id="main"> 
              
            <?php require($_page.".php"); ?> 
  
        </div><!--end of main--> 
          
        <div id="sidebar"> 
              
        </div><!--end of sidebar--> 
  
    </div><!--end container--> 
  
</body> 
</html>