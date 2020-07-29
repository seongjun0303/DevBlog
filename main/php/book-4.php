<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

// Include config file
require_once "config.php";

$quantity = ""; 
$quantity_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["quantity"]))){
        $quantity_err = "Please enter quantity";
    }
    else {
        $quantity = trim($_POST["quantity"]);
    }
    if (empty($quantity_err)){
        //create a cart for a user
        $sql = "UPDATE cart SET book4 = book4 + ? WHERE cartid = ?";
        $stmt = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($stmt, "is", $param_quantity, $param_cartid);
        $param_cartid = $_SESSION["username"];
        $param_quantity = $quantity;
        mysqli_stmt_execute($stmt);

        echo "books have been added";
    }

}

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
    <p>
        <a href="user-browse.php" class="btn btn-warning">Browse Books</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="reset-info.php" class="btn btn-warning">Reset Your Info</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <p><img src="img\book-4.jpg" width="300" height="500"></p>
    <p>
    Title:   Blueprints Visual Scripting for Unreal Engine<br>
    Author:  Marcos Romero<br>
    ISBN:    9781789347067<br>
    User     Rating: 4.84/5<br>
    Price:   39.99<br>
    </p>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group <?php echo (!empty($quantity)) ? 'has-error' : ''; ?>">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                    <span class="help-block"><?php echo $quantity_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-link" href="welcome-admin.php">Cancel</a>
                </div>
        </form>
    </div>
    
</body>
</html>