<html>
<head>
<title>Login to RAIT Portal</title>
</head>
<body>
<center>

<img src="logof.jpg"/>
<table>
<form name="login" method='post' action="login.php">
<tr><td>Roll No.</td>
    <td><input type="text" name="userid"/></td><br><br>
</tr>

<tr>	
<td>Password</td>
<td><input type="password" name="passwd"/></td><br>
</tr>
<!--<input type="submit" name="submit" value="Submit"/>
<input type="reset"/> --><br>
<tr>
    <td><button name="submit" type="submit" value="submit">Login</button></td>
	<td><input type="button" onclick="location.href='mainregister.php';" value="Sign Up"/></td>
</tr>

</form><table></center>
</body>
</html>

<?php
include 'connect.php';

if(isset($_POST['submit']))
{

 $user=$_POST['userid'];
 $passwd=$_POST['passwd'];
 
 $result = mysql_query("SELECT * FROM student where rollno='$user' && password='$passwd' ");
 $count=mysql_num_rows($result);
 $name=mysql_query("select fname,rollno from student where rollno='$user' ");
 while($row=mysql_fetch_object($name))
 {
	 $studname = $row->fname;
	 $roll=$row->rollno;
 }
 
 if($count==1)
 {
	 session_start();
	 $_SESSION['tempuser']=$roll;
	 header("location: home.php");
 }
 else 
{
echo  "*Wrong Username or Password*";
}
 echo $user;
 mysql_close($con);
 
}

?>