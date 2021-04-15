<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: browse.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Prepare a select statement
    $sql = "SELECT id, username, password FROM userdata WHERE username = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = $username;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        // Password is correct, so start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;     
                        $_SESSION["password"] = $password;

                        // Redirect user to welcome page
                        header("location: browse.php");
                    } else{
                        // Display an error message if password is not valid
                        echo "The password you entered was not valid.";
                    }
                }
            } 
            else{
                // Display an error message if username doesn't exist
                echo "No account found with that username.";
            }
        } 
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.ico">
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
                <li><a href="login.php" class="current">Sign In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </header>
        <!----- Header ----->

        <!----- TOP-NAV ----->
        <div class="top-nav">
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="browse.php">BROWSE</a></li>
                <li><a href="about.html">ABOUT US</a></li>
            </ul>
        </div>
        <!----- TOP-NAV ----->

        <!------- Login-Form ----->
        <div class="signup-form">
            <h2>Log In</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" placeholder="Username...">
                <input type="password" name="password" placeholder="Password...">
                <button type="submit" name="submit">Log In</button>
            </form>
        </div>
        <!------- Login-Up-Form ----->
        
        <!----- Footer  ----->
        <div class="footer">
          <img src="images/Logo.png" alt="">
        </div>
        <!----- Footer  ----->
    </body>
</html>