<?php
include 'connect1.php';
include 'login.php';
if(empty($_SESSION))
{// if the session not yet started 
	session_start();
        $roll = $_SESSION['tempuser'];
$user=mysqli_query($con,"select * from studentdetail where ID='$roll'");
while($row=  mysqli_fetch_object($user))
{
    $id = $row->ID;
    $fname = $row->FIRSTNAME; 
    $lname = $row->LASTNAME;
    $name = $fname + $lname;


mysqli_query($con,"insert into 'transaction' (`ID', `Roll_no`, `Name`, `Amount`, `Type`, `time`) values ('','$id','$lname','','','' )");
}
}
if(!isset($_SESSION['tempuser']))
{  //if not yet logged in
   header("Location: index.php");// send to login page
}


?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <title>Making it swipeable - Swipeable Side Menu</title>
    <script type="text/javascript" src="jquery-1.11.1.js"></script>
    <script type="text/javascript" src="jquery.touchSwipe.min.js"></script>
      
    <style>
        a:link, a:visited {
    background-color: #f44336;
    color: white;
    padding: 14px 25px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}
.pay
{
    background-color: #f44336;
    color: white;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
    width: 120px;
    height: 40px;
    font-size: 23px;
}
}
    </style>
    <style type="text/css">
        @font-face {
    font-family: touch;
    src: url('Touch.tff');
        }
        .button {
            width: 120px;
            height: 30px;
            background-color: #180e3a;
            border: 0px;
            color: white;
            font-family: touch;
            font-size: 20px;
        }
      body, html {
          height: 100%;
          margin: 0;
          overflow:hidden;
          font-family: helvetica;
          font-weight: 100;
      }
      .container {
          position: relative;
          height: 100%;
          width: 100%;
          left: 0;
          -webkit-transition:  left 0.4s ease-in-out;
          -moz-transition:  left 0.4s ease-in-out;
          -ms-transition:  left 0.4s ease-in-out;
          -o-transition:  left 0.4s ease-in-out;
          transition:  left 0.4s ease-in-out;
      }
      .container.open-sidebar {
          left: 240px;
      }
      
      .swipe-area {
          position: absolute;
          width: 50px;
          left: 0;
      top: 0;
          height: 100%;
          background: #f3f3f3;
          z-index: 0;
      }
      #sidebar {
          background: #DF314D;
          position: absolute;
          width: 240px;
          height: 100%;
          left: -240px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
      }
      #sidebar ul {
          margin: 0;
          padding: 0;
          list-style: none;
      }
      #sidebar ul li {
          margin: 0;
      }
      #sidebar ul li a {
          padding: 15px 20px;
          font-size: 16px;
          font-weight: 100;
          color: white;
          text-decoration: none;
          display: block;
          border-bottom: 1px solid #C9223D;
          -webkit-transition:  background 0.3s ease-in-out;
          -moz-transition:  background 0.3s ease-in-out;
          -ms-transition:  background 0.3s ease-in-out;
          -o-transition:  background 0.3s ease-in-out;
          transition:  background 0.3s ease-in-out;
      }
      #sidebar ul li:hover a {
          background: #C9223D;
      }
      .main-content {
          width: 100%;
          height: 100%;
          padding: 10px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          position: relative;
      }
      .main-content .content{
          box-sizing: border-box;
          -moz-box-sizing: border-box;
      padding-left: 60px;
      width: 100%;
      }
      .main-content .content h1{
          font-weight: 100;
      }
      .main-content .content p{
          width: 100%;
          line-height: 160%;
      }
      .main-content #sidebar-toggle {
          background: #DF314D;
          border-radius: 3px;
          display: block;
          position: relative;
          padding: 10px 7px;
          float: left;
      }
      .main-content #sidebar-toggle .bar{
           display: block;
          width: 18px;
          margin-bottom: 3px;
          height: 2px;
          background-color: #fff;
          border-radius: 1px;   
      }
      .main-content #sidebar-toggle .bar:last-child{
           margin-bottom: 0;   
      }
    </style>
    <script type="text/javascript">
      $(window).load(function(){
        $("[data-toggle]").click(function() {
          var toggle_el = $(this).data("toggle");
          $(toggle_el).toggleClass("open-sidebar");
        });
         $(".swipe-area").swipe({
              swipeStatus:function(event, phase, direction, distance, duration, fingers)
                  {
                      if (phase=="move" && direction =="right") {
                           $(".container").addClass("open-sidebar");
                           return false;
                      }
                      if (phase=="move" && direction =="left") {
                           $(".container").removeClass("open-sidebar");
                           return false;
                      }
                  }
          }); 
      });
      
    </script>
  </head>
  <body>
    <div class="container">
      <div id="sidebar">
          <ul>
              <li><a href="#">Pay</a></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">Transaction</a></li>
                  <li><a href='logout.php'>Sign Out</a></li>
          </ul>
      </div>
      <div class="main-content">
          <div class="swipe-area"></div>
          <a href="#" data-toggle=".container" id="sidebar-toggle">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
          </a>
          <div class="content">
              <h2>Types Of Fees</h2>
        <form action="" method="POST">
            <input class="button" type="submit" value="Tution Fees" name="tution"><br>
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
            
            <br><input class="button" type="submit" value="Stationary" name="stat">
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
   $_SESSION['tempcost'] = $cost;
   break;
        }}}
        // put your code here
        ?>
            
            
            
            <br><input class="button" type="submit" value="KT Form" name="kt">
            <br>
            <?php
             if(isset($_POST['kt']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='kt'");
  while($ro = mysqli_fetch_object($res))
  {
      $cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
   $_SESSION['tempcost'] = $cost;
   break;
        }}
        // put your code here
        ?>
        
            <br><input class="button" type="submit" value="New Id" name="idc"><br>
            <?php
             if(isset($_POST['idc']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='id'");
  while($ro = mysqli_fetch_object($res))
  {$cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
   $_SESSION['tempcost'] = $cost;
   break;
        }}
        // put your code here
        ?>
            <br><input class="button" type="submit" value="Exam Form" name="exam">
            <br>
            <?php
             if(isset($_POST['exam']))
        {
                  $res = mysqli_query($con,"SELECT cost FROM fixed WHERE type='exam'");
  while($ro = mysqli_fetch_object($res))
  {
      $cost = $ro->cost;
  echo "<b>Cost:</b> Rs. ".$ro->cost;
  break;
        }}
        //$_SESSION['tempcost'] = $cost;
        // put your code here
        ?>
        
            <br><input class="button" type="submit" value="Bundles" name="bundles">
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
   
      $cost = $xy * $ax;
  echo "<b>Cost per Bundle: Rs. </b>". $ax;
  echo "<br><b>Number Of Bundles:</b>".$xy;
  echo "<br><b>Total Cost:</b> Rs. ".$cost;
   $_SESSION['tempcost'] = $cost;
   break;
        }}
        // put your code here
        ?>
            <br><input class="button" type="submit" value="Files" name="files">
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
   
      $cost = $x * $ay;
  echo "<b>Cost per File: Rs. </b>". $ay;
  echo "<br><b>Number Of Files:</b>".$x;
  echo "<br><b>Total Cost:</b> Rs. ".$cost;
  $_SESSION['tempcost'] = $cost;
  break;
        }}
        ?>
            <br><br>
      <a href="https://www.instamojo.com/nishantkarnam/rait-test-payment/" rel="im-checkout" data-behaviour="remote" data-style="light" data-text="Checkout With RAIT SECURE PAYMENT GATEWAY" data-token="965962fb2382f55b5c6bfc9cfd45fd7f"></a>
<script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script></div>
      </div>
    </div>
  </body>
</html>