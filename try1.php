<html>
<head>
<title>FEE PAYMENT</title>
</head>
<body>
<center>

<img src="logof.jpg"/>
<table>
<form method='post' action="">
<tr><td>Roll No. :</td>
    <td><input type="text" name="email"/></td><br><br>
</tr>

<tr>	
<td>Password :</td>
<td><input type="password" name="password"/></td><br>
</tr>
<!--<input type="submit" name="submit" value="Submit"/>
<input type="reset"/> --><br>
<tr>
    <td></td>
    <td><input style="width: 174px;background-color: #9E1C36;color: white;border: 0px;height: 30px;;" type="submit" name="submit" value="Log In"></td>
</tr>


                                            <?php  
  include 'connect1.php';
 // $expiry = time()+3600;
  
   if(isset($_POST['submit'])){
  $id = $_POST['email'];
  $pass =  $_POST['password'];
  $result =  mysqli_query($con,"select * from studentdetail where id='$id' && password='$pass' ");
  $count=  mysqli_num_rows($result);
  $user = mysqli_query($con,"select id from studentdetail where id='$id' ");
  while($row=mysqli_fetch_object($user))
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
header( "refresh:5; url=try1.php" );
}
  
mysqli_close($con);
 }
?>    
</form><table></center>
</body>
</html>