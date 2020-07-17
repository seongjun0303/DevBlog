<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
$active = 0;
$email = "";

require_once "config.php";
$sql = "SELECT * FROM users";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["username"] == $username){
            $active = $row["active"];
            $email = $row["email"];
        }
    }
}
else {
    echo "0 results";
}
$link->close();

if ($active == 1){
    header("location: welcome2.php");
    exit;
}

mail($email, "Verify your email", "Please click the link below in order to verify your email\n\nhttp://seongcho9803.com/php/verify.php");


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to CSCI 4050 Online Bookstore</h1>
    </div>
    <p>Your status is currently <b>admin</b>.</p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>