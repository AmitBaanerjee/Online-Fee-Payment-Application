<?php  
  include 'connect1.php';
 // $expiry = time()+3600;
  
   if(isset($_POST['submit'])){
  $id = $_POST['email'];
  $pass =  $_POST['password'];
  $result =  mysql_query("select * from studentdetail where id='$id' && password='$pass' ");
  $count=mysql_num_rows($result);
  $user = mysql_query("select id from studentdetail where id='$id' ");
  while($row=mysql_fetch_object($user))
  {
  $username = $row->id; 
  }
  
  if($count==1){
  session_start();
     //setcookie('myusername', $id, $expiry);
     //$_SESSION['myusername'] = $username;
     $_SESSION["tempuser"] = $username;
     header("location: first.php");
}

else 
{
echo  "*Wrong Username or Password*";
header( "refresh:1; url=try1.php" );
}
  
  mysql_close($con);
 }
?>

