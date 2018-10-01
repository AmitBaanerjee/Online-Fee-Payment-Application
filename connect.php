<?php 
$localhost = 'localhost';
$username = 'root';
$password = '';


 $con=mysqli_connect($localhost,$username,$password,'try') or exit('connection to db failed');
  //mysql_select_db('try') or exit('unable to contact');
?>