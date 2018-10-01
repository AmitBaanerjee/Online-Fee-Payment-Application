<?php
 session_start();	
	
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

    
   // setcookie('myusername', $id, $expiry);
    header("Location: try1.php");

?>