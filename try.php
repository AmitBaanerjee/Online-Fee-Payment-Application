<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'connect.php';
include 'login.php';
if(empty($_SESSION)) // if the session not yet started 
	session_start();
if(!isset($_SESSION['tempuser']))
{  //if not yet logged in
   header("Location: index.php");// send to login page
}
if(isset($_SESSION['tempuser']))
{	
  
  
  echo "<a href='logout.php'>logout</a>";
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Types Of Fees</h2>
        <form action="" method="POST">
            <input type="submit" value="Tution Fees" name="tution"><br>
             <?php
        
        if(isset($_POST['tution']))
        {
            $x= $_SESSION['tempuser'];
        $result = mysqli_query($con,"SELECT id, batch, firstname, lastname, year, type FROM studentdetail WHERE id='$x'");
       
        while($row = mysqli_fetch_object($result))
  {
            
            echo "<b>ID:</b> ". $row->id."<br>"; 
            echo "<b>BATCH:</b> ".$row->batch."<br>";
            echo "<b>NAME:</b> ".$row->firstname." ";
            echo $row->lastname."<br>";
            echo "<b>YEAR:</b> ".$row->year."<br>";
            echo "<b>TYPE:</b> ".$row->type."<br>";
            $a = $row->batch;
            $b = $row->type;
            $c = $row->year;
  
  $res = mysqli_query($con,"SELECT cost FROM tutionfee WHERE batch='$a' && type='$b' && year='$c'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
        }}}
        // put your code here
        ?>
            
            <br><input type="submit" value="Stationary" name="stat">
            <br>
            <?php
            if(isset($_POST['stat']))
        {$x= $_SESSION['tempuser'];
           
        $result = mysqli_query($con,"SELECT id, batch, firstname, lastname, year, semester FROM studentdetail WHERE id='$x'");
       
        while($row = mysqli_fetch_object($result))
  {
            
            echo "<b>ID:</b> ". $row->id."<br>"; 
            echo "<b>BATCH:</b> ".$row->batch."<br>";
            echo "<b>NAME:</b> ".$row->firstname." ";
            echo $row->lastname."<br>";
            echo "<b>YEAR:</b> ".$row->year."<br>";
            echo "<b>SEM:</b> ".$row->semester."<br>";
            $a = $row->semester;
  
  $res = mysqli_query($con,"SELECT cost FROM stationary WHERE sem='$a'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
        }}}
        // put your code here
        ?>
            
            
            
            <br><input type="submit" value="KT Form" name="kt">
            <br>
            <?php
             if(isset($_POST['kt']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='kt'");
  while($ro = mysqli_fetch_object($res))
  {
      $cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
        }}
        // put your code here
        ?>
        
            <br><input type="submit" value="New Id" name="idc"><br>
            <?php
             if(isset($_POST['idc']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='id'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
        }}
        // put your code here
        ?>
            <br><input type="submit" value="Exam Form" name="exam">
            <br>
            <?php
             if(isset($_POST['exam']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='exam'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
        }}
        // put your code here
        ?>
        
        <br><input type="submit" value="Bundles" name="bundles">
            <br>
            <?php
            if(isset($_POST['bundles']))
        {?><form action="" method="POST">
            <input type="number" name="number" placeholder="Number of Bundles">
            <input type="submit" name="sub" value="Submit">
        </form><?php
        }
            if(isset($_POST['sub'])){
  $xy = $_POST['number'];
  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='bundles'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  $ax = $ro->cost;
   
      $a = $xy * $ax;
  echo "<b>Cost per Bundle: Rs. </b>". $ax;
  echo "<br><b>Number Of Bundles:</b>".$xy;
  echo "<br><b>Total Cost:</b> Rs. ".$a;
        }}
        // put your code here
        ?>
            <br><input type="submit" value="Files" name="files">
            <br>
            <?php
            if(isset($_POST['files']))
        {?><form action="" method="POST">
            <input type="number" name="num" placeholder="Number of Files">
            <input type="submit" name="subm" value="Submit">
        </form><?php
        }
            if(isset($_POST['subm'])){
  $x = $_POST['num'];
  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='files'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  $ay = $ro->cost;
   
      $b = $x * $ay;
  echo "<b>Cost per File: Rs. </b>". $ay;
  echo "<br><b>Number Of Files:</b>".$x;
  echo "<br><b>Total Cost:</b> Rs. ".$b;
        }}
        // put your code here
        echo 'Proceed With Payment';
        ?>
            
        </form>
            </body>
</html>
