<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$book_id = $quantity = 0;
$book_id_err = $quantity_err = ""; 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate parameters
    if(empty(trim($_POST["book_id"]))){
        $book_id_err = "Please enter the book id.";     
    } 
    else{
        $book_id = trim($_POST["book_id"]);
    }

    if(empty(trim($_POST["quantity"]))){
        $quantity_err = "Please enter the quantity.";     
    } 
    else{
        $quantity = trim($_POST["quantity"]);
    }

    // Check input errors before updating the database
    if(empty($book_id_err)&& empty($quantity_err)){
        // Prepare an update statement
        $sql = "UPDATE book SET quantity = quantity+? WHERE id = ?";
        

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_quanity, $param_id);

            // Set parameters
            $param_quanity = $quantity;
            $param_id = $book_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                 
                //header("location: login.php"); change location according to book id
                echo "Books added!";

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Add books</h2>
        <p>Please fill out this form to add books</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($book_id_err)) ? 'has-error' : ''; ?>">
                <label>Book id</label>
                <input type="number" name="book_id" class="form-control" value="<?php echo $book_id; ?>">
                <span class="help-block"><?php echo $book_id_err; ?></span>
            </div>
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