<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $fullname = $email = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Prepare an insert statement
    $sql = "INSERT INTO userdata (fullname, email, username, password) VALUES (?,?,?,?)";

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $param_fullname, $param_email, $param_username, $param_password);

        // Set parameters
        $param_fullname = $fullname;
        $param_email = $email;
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        if(mysqli_stmt_execute($stmt)){
            header("location: login.php");
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
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
                <li><a href="login.php">Sign In</a></li>
                <li><a href="signup.php"  class="current">Sign Up</a></li>
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

        <!------- Sign-Up-Form ----->
        <div class="signup-form">
            <h2>Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="fullname" placeholder="Full Name...">
                <input type="text" name="email" placeholder="Email...">
                <input type="text" name="username" placeholder="Username...">
                <input type="password" name="password" placeholder="Password...">
                <input type="password" name="confirm_password" placeholder="Repeat password">
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
        <!------- Sign-Up-Form ----->

        <!----- Footer  ----->
        <div class="footer">
          <img src="images/Logo.png" alt="">
        </div>
        <!----- Footer  ----->
    </body>
</html>