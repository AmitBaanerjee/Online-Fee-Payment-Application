<?php
include 'connect1.php';
//include 'pay.php';
if(empty($_SESSION)) // if the session not yet started 
	session_start();
if(!isset($_SESSION['tempuser']))
{  //if not yet logged in
   header("Location: index.php");// send to login page
}


//$num = $_COOKIE['num'];
$num=$_SESSION['tempnum'];
$sql = "select * from 'bank' where card='$num'" ;
$result = mysqli_query($con,$sql);
$user = mysqli_query($con,"select Name,email_id from bank where card='$num'");
$x= substr($num, -4);
while($row=mysqli_fetch_object($user))
{
    $name= $row->Name;
    $email= $row->email_id;
}
$y = $_SESSION['tempcost'];
?>

<html>

<head>
	<title>Bank Security Service - Choose Authentication Type</title>
</head>
<BODY>
    
  <tr height="2%"> 
    
	

	<td colspan="2">&nbsp;&nbsp;<FONT face=arial color=#003366 size=4><center><B>Select your Authentication type</center></B></FONT> 
	<br>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center"><tr><td>
	
		

			
</table>
						
			
					<div style="text-align:justify">
						<FONT SIZE="3" COLOR="black"></br>
							<center>Please Enter OTP sent to email registered with the bank.</center>
						</FONT>
					</div>
				
			

	</td>
	
</tr>
	</table>
	</td>
  </tr><form action="" method="post">  
  <center><table> <tr><td><FONT SIZE="3" COLOR="black"><center><b> NAME :</center></td><td><?php          echo $name; ?></td></tr></b></br></center></font><tr>
              <td><FONT SIZE="3" align="left"  COLOR="black">   <b><center>EMAIL :</center></td></b><td><?php          echo $email; ?></td></tr></br></font>
   <tr><td><FONT SIZE="3" COLOR="black"><center><b>Card Number :</center></td><td><?php          echo 'XXXX-XXXX-XXXX-'.$x; ?></td></tr></b></br>
   <tr><td><FONT SIZE="3" COLOR="black"><center><b>Amount :</center></td><td><?php          echo 'Rs.'.$y; ?></td></tr></b></br></center></font>      
   <tr><td><FONT SIZE="3" COLOR="black"><center><b>OTP :</center></td><td><input type="password" name="otp"></td></tr></b></br></center>
  </table>
  
	
<center><br><input type="submit" name="submit" value="Proceed"/></br></center>	
<?php
 if(isset($_POST['submit']))
        {
    $a = $_SESSION['tempcost'];
     $x= $_POST['otp'];
     $sql="select * from bank where Card='$num'";
     $result = mysqli_query($con,$sql);
     while($row= mysqli_fetch_object($result))
     {
         $o= $row->otp;
         $b= $row->Amount;
     }
     $sql1="select * from bank where Name='rait'";
     $result1 = mysqli_query($con,$sql1);
     while($row1= mysqli_fetch_object($result1))
     {
         
         $rait= $row1->Amount;
     }
     if($o==$x)
     {
         if($b>$a){
             $b=$b-$a;
             $rait= $rait+$a;
             mysqli_query($con,"update bank set Amount='$rait' where Name='rait'");
             mysqli_query($con,"update bank set Amount='$b' where Card='$num'");
             header('location: success.php');
         }
         else
         {
             header('location : receipt.php');
         }
     }
 else {
         echo 'Wrong OTP';    
     }

       }
?>
</form>
  
  
  </body>
</html>


</body>
</html>



