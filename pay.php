<?php
include 'connect1.php';
//include 'login.php';
if(empty($_SESSION)) // if the session not yet started 
	session_start();
if(!isset($_SESSION['tempuser']))
{  //if not yet logged in
   header("Location: index.php");// send to login page
}
$x= $_SESSION['tempcost'];
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <script type="text/javascript" src="jquery-1.11.1.js"></script>
    <script type="text/javascript" src="jquery.touchSwipe.min.js"></script>
      <style>
        .a{
    background-color: #f44336;
    color: white;
    padding: 14px 25px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}
    </style>
    <style>
        a:link, a:visited {
    background-color: #f44336;
    color: white;
    padding: 14px 25px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}
    </style>
    <style type="text/css">
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
              <li><a href="first.php">Pay</a></li>
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
              <h2>Debit Card Details</h2>
        <form action="" method="POST">
            <table border="0"><tr>
                    <td><b>Card Holder Name: </td><td><input type="text" name="name"></b></td></tr>
                <tr><td><b>Card Number: </td><td><input type="text" name="num"></b></td></tr>
                <tr><td><b>Expiry Date:</td><td> <input type="number" name="year"></b></td></tr>
                <tr><td><b>CVV:</td><td><input type="password" name="cvv"> </b></td></tr><br>
                <tr><td><b>Amount:</td><td><?php          echo 'Rs. '.$x; ?></td></tr></table><br><br>
            <input class="a" type="submit" value="Pay Now" name="subm">
                <?php
            if(isset($_POST['subm']))
        {
             $name = $_POST['name'];
  $num =  $_POST['num'];
  $year = $_POST['year'];
  $cvv = $_POST['cvv'];
  $sql = "select * from `bank` where `Name`='$name' && `Card`='$num' && `Expiry`='$year' && `CVV`='$cvv'";
  $result1 =  mysqli_query($con,$sql);
  $count=mysqli_num_rows($result1);
  $user = mysqli_query($con,"select amount from bank where Card='$num' ");
  while($row=mysqli_fetch_object($user))
  {
  $amo = $row->amount;
  
  }
  
  
  if($count==1){
      //$expiry= time()+3600;
      session_start();
      $_SESSION['tempnum']=$num;
 // session_start();
     //setcookie("num", $num, $expiry);
     //$_SESSION['myusername'] = $username;
  //  $_SESSION["tempamount"] = $amo;
     header("location: pay1.php");
}

else 
{
echo  "<br><br><font color='red' size='4'>*Wrong Card Details*</font>";
//header( "refresh:1; url=pay.php" );
}
        }
        ?>
            
        </form>
          </div>
      </div>
    </div>
  </body>
</html>
