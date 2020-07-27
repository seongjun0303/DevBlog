<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to CSCI 4050 Online Bookstore</h1>
    </div>
    <p>
        <a href="user-browse.php" class="btn btn-warning">Browse Books</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="reset-info.php" class="btn btn-warning">Reset Your Info</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

    <p>Here are all the available books.</p>

    <p><a href="book-1.php"><img src="img\book-1.jpg" width="300" height="500"></a><b> Learn Android Studio 4</b></p>

    <p><a href="book-2.php"><img src="img\book-2.jpg" width="300" height="500"></a><b> Learning Web Design</b></p>

    <p><a href="book-3.php"><img src="img\book-3.jpg" width="300" height="500"></a><b> Mastering Unity Scripting</b></p>

    <p><a href="book-4.php"><img src="img\book-4.jpg" width="300" height="500"></a><b> Blueprints Visual Scripting for Unreal Engine</b></p>

    <p><a href="book-5.php"><img src="img\book-5.jpg" width="300" height="500"></a><b> Cloud Native Patterns</b></p>

</body>
</html>