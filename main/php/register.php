<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$firstname = $lastname = $address = $fullname = $cardnumber = $expiration = $cvc = "";
$firstname_err = $lastname_err = $address_err = $fullname_err = $cardnumber_err = $expiration_err = $cvc_err = "";
$email = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter firstname";
    }
    else{
        $firstname = trim($_POST["firstname"]);
    }

    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter lastname";
    }
    else{
        $lastname = trim($_POST["lastname"]);
    }

    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter address";
    }
    else{
        $address = trim($_POST["address"]);
    }

    // Validate fullname
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter fullname";
    }
    else{
        $fullname = trim($_POST["fullname"]);
    }

    // Validate cardnumber
    if(empty(trim($_POST["cardnumber"]))){
        $cardnumber_err = "Please enter card number";
    }
    else{
        $cardnumber = trim($_POST["cardnumber"]);
    }

    // Validate expiration date
    if(empty(trim($_POST["expiration"]))){
        $expiration_err = "Please enter expiration date";
    }
    else{
        $expiration = trim($_POST["expiration"]);
    }

    // Validate cvc date
    if(empty(trim($_POST["cvc"]))){
        $cvc_err = "Please enter cvc";
    }
    else{
        $cvc = trim($_POST["cvc"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email";
    }
    else{
        $email = trim($_POST["email"]);
    }


    // Check input errors before inserting in database
    if( && empty($password_err) && empty($confirm_password_err) && empty($firstname_err)&& empty($lastname_err)&&empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, firstname, lastname, address, fullname, cardnumber, expiration, cvc, email) VALUES (?, ?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssiis", $param_username, $param_password, $param_firstname, $param_lastname, $param_address, $param_fullname, $param_cardnumber, $param_expiration, $param_cvc, $param_email);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_address = $address;
            $param_fullname = $fullname;
            $param_expiration = $expiration;
            $param_cardnumber = password_hash($cardnumber, PASSWORD_DEFAULT);
            $param_cvc = $cvc;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page


                //create a cart for a user
                $sql = "INSERT INTO cart (cartid, book1, book2, book3, book4, book5) VALUES (?, 0, 0, 0, 0, 0)";
                $stmt = mysqli_prepare($link,$sql);
                mysqli_stmt_bind_param($stmt, "s", $param_cartid);
                $param_cartid = $username;
                mysqli_stmt_execute($stmt);

                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.\n";
                echo mysqli_stmt_error($stmt);
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>Firstname</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>
            <p>Payment info</p>
            <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                <label>Full name as it appears on card</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                <span class="help-block"><?php echo $fullname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($cardnumber_err)) ? 'has-error' : ''; ?>">
                <label>Card number</label>
                <input type="password" name="cardnumber" class="form-control" value="<?php echo $cardnumber; ?>">
                <span class="help-block"><?php echo $cardnumber_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($expiration_err)) ? 'has-error' : ''; ?>">
                <label>Expiration Date (enter 4 digits)</label>
                <input type="number" name="expiration" class="form-control" value="<?php echo $expiration; ?>">
                <span class="help-block"><?php echo $expiration_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($cvc_err)) ? 'has-error' : ''; ?>">
                <label>CVC</label>
                <input type="number" name="cvc" class="form-control" value="<?php echo $cvc; ?>">
                <span class="help-block"><?php echo $cvc_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>