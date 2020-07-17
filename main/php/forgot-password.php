<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$cur_username = $cur_username_err = "";
$cur_email = $cur_email_err = "";
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty(trim($_POST["cur_username"]))){
        $cur_username_err = "Please enter your current username";
    }

    if(empty(trim($_POST["cur_email"]))){
        $cur_email_err = "Please enter your current email";
    }
    $valid_input = false;

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($cur_username_err)&& empty($cur_email_err)){
        // Prepare an update statement

        $sql = "SELECT * FROM users";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["username"] == $_POST["cur_username"]){
                    if ($row["email"] == $_POST["cur_email"]) {
                        $valid_input = true;
                    }
                }
            }
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($cur_username_err)&& empty($cur_email_err) && $valid_input){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE username = ? AND email = ? ";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_password, $param_username, $param_email);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $_POST["cur_username"];
            $param_email = $_POST["cur_email"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Ooops!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    elseif(!($valid_input)){
        echo "Oops! Username or Email incorrect";
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($cur_username_err)) ? 'has-error' : ''; ?>">
                <label>Current Username</label>
                <input type="text" name="cur_username" class="form-control" value="<?php echo $cur_username; ?>">
                <span class="help-block"><?php echo $cur_username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($cur_email_err)) ? 'has-error' : ''; ?>">
                <label>Current Email</label>
                <input type="text" name="cur_email" class="form-control" value="<?php echo $cur_email; ?>">
                <span class="help-block"><?php echo $cur_email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="login.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>