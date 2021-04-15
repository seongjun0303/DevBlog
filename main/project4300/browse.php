<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "hi";
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
    content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="icon" type="image/png" sizes="32x32"      href="images/favicon.ico">
  </head>

  <body>
    <!----- Header ----->
        <header>
            <img src="images/Logo.png" alt="Imagine Bookstore" usemap="#workmap">
            <map name="#workmap">
                <area shape="square" coords="0,0,200,200" href="index.html" alt="">
            </map>
            <div class="search-container">
                <form action="action_page.php">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
            </div>
            <ul>
                <li><a href="#"><img src="images/shopping-cart.png" alt="Shopping Cart" id="shopping-cart">Cart</a></li>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </header>
        <!----- Header ----->

        <!----- TOP-NAV ----->
        <div class="top-nav">
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="browse.html">BROWSE</a></li>
                <li><a href="about.html" class="current">ABOUT US</a></li>
            </ul>
        </div>
        <!----- TOP-NAV ----->
</html>