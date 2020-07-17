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
$firstname = $lastname = $address = $fullname = $cardnumber = $expiration = $cvc = "";
$firstname_err = $lastname_err = $address_err = $fullname_err = $cardnumber_err = $expiration_err = $cvc_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate parameters
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter the new first name.";     
    } 
    else{
        $firstname = trim($_POST["firstname"]);
    }

    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter the new last name.";     
    } 
    else{
        $lastname = trim($_POST["lastname"]);
    }
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter the new address.";     
    } 
    else{
        $address = trim($_POST["address"]);
    }
    if(empty(trim($_POST["cardnumber"]))){
        $cardnumber_err = "Please enter the new card number.";     
    } 
    else{
        $cardnumber = trim($_POST["cardnumber"]);
    }
    if(empty(trim($_POST["expiration"]))){
        $expiration_err = "Please enter the new expiration date.";     
    } 
    else{
        $expiration = trim($_POST["expiration"]);
    }
    if(empty(trim($_POST["cvc"]))){
        $cvc_err = "Please enter the new cvc.";     
    } 
    else{
        $cvc = trim($_POST["cvc"]);
    }
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter the new fullname.";     
    } 
    else{
        $fullname = trim($_POST["fullname"]);
    }
    

    // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET firstname = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_firstname, $param_id);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET lastname = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_lastname, $param_id);
            
            // Set parameters
            $param_lastname = $lastname;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

     // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET address = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_address, $param_id);
            
            // Set parameters
            $param_address = $address;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET fullname = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_fullname, $param_id);
            
            // Set parameters
            $param_fullname = $fullname;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET cardnumber = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_cardnumber, $param_id);
            
            // Set parameters
            $param_cardnumber = password_hash($cardnumber, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before updating the database
    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET expiration = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_expiration, $param_id);
            
            // Set parameters
            $param_expiration = $expiration;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if(empty($firstname_err)&& empty($lastname_err)&& empty($address_err)&& empty($fullname_err)&& empty($cardnumber_err)&& empty($expiration_err)&& empty($cvc_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET cvc = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_cvc, $param_id);
            
            // Set parameters
            $param_cvc = $cvc;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Reset Info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Info</h2>
        <p>Please fill out this form to reset your info. You cannot modify your email.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                <label>Full Name on card</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                <span class="help-block"><?php echo $fullname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($cardnumber_err)) ? 'has-error' : ''; ?>">
                <label>Card number</label>
                <input type="password" name="cardnumber" class="form-control" value="<?php echo $cardnumber; ?>">
                <span class="help-block"><?php echo $cardnumber_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($expiration_err)) ? 'has-error' : ''; ?>">
                <label>Expiration</label>
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
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>