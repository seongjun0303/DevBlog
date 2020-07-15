<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
require_once "config.php";
$sql = "UPDATE users SET active = 1 WHERE username = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();

$link->close();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to CSCI 4050 Online Bookstore</h1>
    </div>
    <p>Your status is currently <b>active</b>.</p>
    <p>Thank you for confirming your email.</p>
</body>
</html>