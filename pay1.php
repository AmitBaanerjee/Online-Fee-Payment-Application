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
							<center>Please verify your contact details registered with the bank.</center>
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
  </table>
  
	<FONT SIZE="4" COLOR="black"><br>Please select an option to continue with the transaction</FONT><br><br>
	</td>
        </tr></center>
	<tr  valign="top" > 
		<td  colspan="2"   >
			<div class="normal" style="margin-left:50px" >
                            <center><font size="4" color="black"><table><tr>
                                    <input type="radio" name="mode" value="otp">OTP via Email<br/></tr>
                                    <tr><input type="radio" name="mode" value="pass">3D Secure Password</br></tr>
                                    </font></table></center>
			</div>
		</td>
	</tr>

<center><br><input type="submit" name="submit" value="submit"/></br></center>	
<?php
 if(isset($_POST['submit']))
        {
   
     $x= $_POST['mode'];
    //echo 'abc';
     if($x=="otp")
     {
         $generated_password = substr(md5(rand(999,999999)),0,6);
        mysqli_query($con,"UPDATE bank SET otp='$generated_password' WHERE Card='$num'");
        $abc = $_SESSION['tempcost'];
        $x= substr($num, -4);
       // echo $generated_password."submitted successfully!!!";
        require '\PHPMailer-master\PHPMailerAutoload.php';

            define('GUSER', 'raitfee@gmail.com'); // GMail username
            define('GPWD', 'asdfghjkl;123'); // GMail password
            $to=$email;
            $from='raitfee@gmail.com';
            $from_name='RAIT Bank' ;
            $subject='OTP for payment' ;
            $body='To pay Rs.'.$abc.' to RAIT from your card XXXX-XXXX-XXXX-'.$x.'. Use OTP. Beware! ONLY FRAUDSTER ask for OTP on mail. OTP is '.$generated_password.'. Do not share it with anyone';

            global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		header("location: otp.php");
	}
        
        
     }
       else
         header("location: pass.php");
 }
?>
</form>
  
  
  </body>
</html>


</body>
</html>



